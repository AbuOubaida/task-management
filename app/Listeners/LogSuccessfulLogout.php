<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //Update Event/Auth/Login user last login history logout_time
        LoginHistory::where('user_id',$event->user->id)->whereNull('logout_time')->latest()->first()?->update(['logout_time'=>now()]);
    }
}
