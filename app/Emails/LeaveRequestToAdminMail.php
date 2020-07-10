<?php

namespace App\Emails;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Setting;

class LeaveRequestToAdminMail extends BaseMail
{

    private $admin = null;
    private $website = null;
    private $dates = null;
    private $leaveType = null;
    private $reason = null;

    public function __construct(Admin $admin, $website,$dates,$leaveType, $reason)
    {
        parent::__construct();
        $this->admin = $admin;
        $this->dates = $dates;
        $this->leaveType = $leaveType;
        $this->reason = $reason;
        $this->website = $website;
        $this->setting = Setting::firstOrFail();
    }


    public function build()
    {
        return parent::build()
            ->subject('Leave Request - '.$this->website)
            ->with('fullName', $this->admin->name)
            ->with('email', $this->admin->email)
            ->with('dates', $this->dates)
            ->with('leaveType', $this->leaveType)
            ->with('reason', $this->reason)
            ->view('emails.leave_request', $this->viewData);
    }

}
