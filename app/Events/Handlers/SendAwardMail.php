<?php

namespace App\Events\Handlers;


use App\Events\AwardEvent;


class SendAwardMail
{

    public function handle(AwardEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->queue(new \App\Emails\AwardMail($event->employee, $event->awardName));
    }

}