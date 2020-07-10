<?php

namespace App\Events\Handlers;

use App\Emails\LeaveRequestMail;
use App\Events\LeaveRequestEvent;

class SendLeaveRequestMail
{

    public function handle(LeaveRequestEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->queue(new LeaveRequestMail($event->employee, $event->date, $event->status));
    }

}