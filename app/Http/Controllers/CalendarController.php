<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\ListsRepository;

class CalendarController extends Controller
{

    private $eventRepository;
    private $listsRepository;

    public function __construct(EventRepository $eventRepository,
                                ListsRepository $listsRepository){
        $this->eventRepository = $eventRepository;
        $this->listsRepository = $listsRepository;
    }

    public function index(){
        $events = $this->eventRepository
                        ->all();
        $holidays = $this->eventRepository
                        ->whereThenOrderByAsc('event_type_id', '<', '7', 'start');
        $upcomingEvents = $this->eventRepository
                                ->whereThenOrderByAsc('start', '>', \Carbon\Carbon::now(), 'start');
        return view('calendar_pages.index', compact(['holidays', 'upcomingEvents', 'events']));
    }

    public function create(){
        $eventTypes = $this->listsRepository->lists('\App\EventType', 'name', 'id');

        return view('calendar_pages.create', compact(['eventTypes']));
    }

    public function store(Requests\EventRequest $request){
        $this->eventRepository->create($request->all());
        return redirect('/calendar');
    }

    public function show(\App\Event $event){

    }

    public function edit(\App\Event $event){
        $eventTypes = $this->listsRepository->lists('\App\EventType', 'name', 'id');

        return view('calendar_pages.edit', compact(['event', 'eventTypes']));
    }

    public function update(Requests\EventRequest $request, \App\Event $event){
        $this->eventRepository->updateByModel($request, $event);
        return redirect('/calendar')->withMessage('Event has been updated successfully!');
    }

    public function destroy(\App\Event $event){
        if(!$this->eventRepository
                ->deleteByModel($event)){
            return redirect('/calendar')->withMessage('Unable to delete event.');
        }
        return redirect('/calendar');
    }

    public function events(Request $request){
        if(!$request->ajax()){
            return redirect()->back();
        }
        $events = $this->eventRepository
                        ->orderByAsc('start');
        return $events;
    }
}
