<?php

namespace App\Observers;

use App\Events\NoticeBoardEvent;
use App\Models\Employee;
use App\Models\Noticeboard;
use App\Models\Setting;

class NoticeboardObserver
{
    /**
     * Handle the noticeboard "created" event.
     *
     * @param  \App\Models\Noticeboard $noticeboard
     * @return void
     */
    public function created(Noticeboard $noticeboard)
    {
        if (!\App::runningInConsole()) {

            $setting = Setting::first();

            if ($setting->notice_notification) {
                // Send email to all employees
                $employees = Employee::select('id', 'email')->active()->get();

                foreach ($employees as $employee) {
                    event(new NoticeBoardEvent($employee));
                }
            }
        }

    }

}
