<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\ListsRepository;

class EmployeeManagementController extends Controller
{

    protected $employeeRepository;
    protected $listsRepository;

    public function __construct(RepositoryInterface $employeeRepository, 
                                ListsRepository $listsRepository){
        $this->employeeRepository = $employeeRepository;
        $this->listsRepository = $listsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employeeRepository
                            ->all(['id','first_name','middle_name','last_name','department_id','position_id']);

        return view('employee-management_pages.index', compact(['employees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = $this->listsRepository->lists('\App\Position', 'name', 'id');
        $departments = $this->listsRepository->lists('\App\Department', 'name', 'id');
        $designations = $this->listsRepository->lists('\App\Designation', 'name', 'id');
        $businessUnits = $this->listsRepository->lists('\App\BusinessUnit', 'name', 'id');
        $benefits = $this->listsRepository->listsAsSimpleArray('\App\Benefit', 'name', 'id');

        return view('employee-management_pages.create', 
                    compact(['positions','departments','designations','businessUnits','benefits']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateEmployeeRequest $request)
    {
        if(!$this->employeeRepository->create($request->all())){
            return redirect('/employees/create')
                    ->withMessage('Something went wrong. Please try again.');
        }

        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Employee $employee)
    {
        return view('employee-management_pages.show', compact(['employee']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Employee $employee)
    {
        $positions = $this->listsRepository->lists('\App\Position', 'name', 'id');
        $departments = $this->listsRepository->lists('\App\Department', 'name', 'id');
        $designations = $this->listsRepository->lists('\App\Designation', 'name', 'id');
        $businessUnits = $this->listsRepository->lists('\App\BusinessUnit', 'name', 'id');
        $benefits = $this->listsRepository->listsAsSimpleArray('\App\Benefit', 'name', 'id');
        return view('employee-management_pages.edit', compact(['employee', 'positions','departments','designations','businessUnits','benefits']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, \App\Employee $employee)
    {
        if(!$this->employeeRepository->updateByModel($request->all(), $employee)){
            return redirect('/employees/'. $employee->id . '/edit')
                    ->withMessage('Something went wrong. Please try again.');
        }

        return redirect(url('/employees', $employee->id))->withMessage('Employee has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Employee $employee)
    {
        if(!$this->employeeRepository
                ->deleteByModel($employee)){
            return redirect('/employees')->withMessage('Unable to delete employee.');
        }
        return redirect('/employees');
    }

    public function matchEmployees(Request $request){
        if(!$request->ajax()){
            return redirect()->back()->withMessage('Unable to fetch data. Please try again.');
        }
        $employees = $this->employeeRepository
                            ->matchBoth([
                                'id' => $request->username,
                                'first_name' => $request->username,
                                'middle_name' => $request->username,
                                'last_name' => $request->username,
                                'suffix' => $request->username
                                ], 4);
        return $employees;
    }
}
