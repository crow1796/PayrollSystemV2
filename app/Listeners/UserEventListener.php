<?php

namespace App\Listeners;

use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Eloquent\LogRepository;

class UserEventListener
{

    protected $logRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * Handle the event.
     *
     * @param  User  $event
     * @return void
     */
    public function handle($event)
    {
        return $this->logRepository->create($event->toArray() + ['last_login' => \Carbon\Carbon::now()]);
    }
}
