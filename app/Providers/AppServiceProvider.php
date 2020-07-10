<?php

namespace App\Providers;

use App\Events\AttendanceEvent;
use App\Events\AwardEvent;
use App\Events\ChangePasswordEvent;
use App\Events\CreateEmployeeEvent;
use App\Events\Handlers\ChangePasswordMail;
use App\Events\Handlers\SendAwardMail;
use App\Events\Handlers\SendCreateEmployeeMail;
use App\Events\Handlers\SendEmployeeAttendanceMail;
use App\Events\Handlers\SendLeaveRequestMail;
use App\Events\Handlers\SendLeaveRequestToAdminMail;
use App\Events\Handlers\SendNoticeBoardMail;
use App\Events\LeaveRequestEvent;
use App\Events\LeaveRequestToAdminEvent;
use App\Events\LeaveRequestToEvent;
use App\Events\NoticeBoardEvent;
use App\Models\Noticeboard;
use App\Observers\NoticeboardObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Event::listen(AttendanceEvent::class, SendEmployeeAttendanceMail::class);
        \Event::listen(LeaveRequestEvent::class, SendLeaveRequestMail::class);
        \Event::listen(LeaveRequestToAdminEvent::class, SendLeaveRequestToAdminMail::class);
        \Event::listen(ChangePasswordEvent::class, ChangePasswordMail::class);
        \Event::listen(NoticeBoardEvent::class, SendNoticeBoardMail::class);
        \Event::listen(CreateEmployeeEvent::class, SendCreateEmployeeMail::class);
        \Event::listen(AwardEvent::class, SendAwardMail::class);


        // Observers
        Noticeboard::observe(NoticeboardObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
