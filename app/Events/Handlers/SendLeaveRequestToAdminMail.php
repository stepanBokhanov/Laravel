<?php

namespace App\Events\Handlers;

use App\Emails\LeaveRequestToAdminMail;
use App\Events\LeaveRequestToAdminEvent;

class SendLeaveRequestToAdminMail
{

    public function handle(LeaveRequestToAdminEvent $event)
    {
        \Mail::to($event->admin->email, $event->admin->name)
            ->queue(new LeaveRequestToAdminMail($event->admin, $event->website,$event->dates,$event->leaveType,$event->reason));
    }

}