<?php

namespace App\Emails;

use App\Models\Employee;
use App\Models\Setting;

class LeaveRequestMail extends BaseMail
{

    private $employee = null;
    private $date = null;
    private $status = null;

    public function __construct(Employee $employee, $date, $status)
    {
        parent::__construct();
        $this->employee = $employee;
        $this->date = $date;
        $this->status = $status;
        $this->setting = Setting::firstOrFail();
    }

    public function build()
    {
        return parent::build()
            ->subject('Leave Request')
            ->with('fullName', $this->employee->fullName)
            ->with('email', $this->employee->email)
            ->with('date', $this->date)
            ->with('status', $this->status)
            ->view('emails.admin.leave_request', $this->viewData);
    }

}
