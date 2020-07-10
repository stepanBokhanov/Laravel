<?php

namespace App\Events\Handlers;


use App\Events\ChangePasswordEvent;


class ChangePasswordMail
{

    public function handle(ChangePasswordEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->queue(new \App\Emails\ChangePasswordMail($event->employee));
    }

}