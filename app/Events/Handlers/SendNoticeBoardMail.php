<?php

namespace App\Events\Handlers;

use App\Emails\LeaveRequestMail;
use App\Emails\NoticeBoardMail;
use App\Events\LeaveRequestEvent;
use App\Events\NoticeBoardEvent;

class SendNoticeBoardMail
{

    public function handle(NoticeBoardEvent $event)
    {
        \Mail::to($event->employee->email, $event->employee->fullName)
            ->send(new NoticeBoardMail($event->employee));
    }

}