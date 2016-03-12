<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\LogRepository;
use App\Repositories\ListsRepository;
use Auth;

class ControlAccessController extends Controller
{

	protected $userRepository;
	protected $listsRepository;
	protected $logRepository;

	public function __construct(UserRepository $userRepository, ListsRepository $listsRepository, LogRepository $logRepository){
		$this->userRepository = $userRepository;
		$this->listsRepository = $listsRepository;
		$this->logRepository = $logRepository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = $this->userRepository->all()->except(Auth::user()->id);
        return view('control-access_pages.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$permissionTypes = $this->listsRepository->lists('\App\Permission', 'name', 'id');
    	$users = $this->userRepository->all();
        return view('control-access_pages.create', compact(['users', 'permissionTypes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
    	if(!$this->userRepository->create($request->all())){
    	    return redirect('/control-access/create')
    	            ->withMessage('Something went wrong. Please try again.');
    	}

    	return redirect('/control-access');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(\App\User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\User $user)
    {
    	$permissionTypes = $this->listsRepository->lists('\App\Permission', 'name', 'id');
    	return view('control-access_pages.edit', compact(['user', 'permissionTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, \App\User $user)
    {
    	if(!$this->userRepository->updateByModel($request->all(), $user)){
    	    return redirect('/contol-access/'. $user->id . '/edit')
    	            ->withMessage('Something went wrong. Please try again.');
    	}
    	return redirect(url('/control-access', $user->id))->withMessage('User information has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\User $user)
    {
        $this->userRepository->deleteByModel($user);
        return redirect('/control-access')->withMessage('User has been deleted successfully.');
    }

    public function logs(){
    	$logs = $this->logRepository->all();
    	return view('control-access_pages.logs', compact(['logs']));	
    }

    public function logDestroy(\App\Log $log){
    	$this->logRepository->deleteByModel($log);
    	return redirect('/control-access/logs')->withMessage('Log has been deleted successfully.');
    }
}
