<?php

namespace App\Events\Handlers;

use App\Emails\CreateEmployeeMail;
use App\Events\CreateEmployeeEvent;

class SendCreateEmployeeMail
{

    public function handle(CreateEmployeeEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->queue(new CreateEmployeeMail($event->employee, $event->password));
    }

}