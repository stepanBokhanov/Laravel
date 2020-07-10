<?php

namespace App\Events\Handlers;

use App\Emails\EmployeeAttendanceMail;
use App\Events\AttendanceEvent;


class SendEmployeeAttendanceMail
{

    public function handle(AttendanceEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->queue(new EmployeeAttendanceMail($event->employee, $event->date));

    }

}