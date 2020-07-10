<?php

namespace App\Emails;

use App\Models\Employee;
use App\Models\Setting;

class CreateEmployeeMail extends BaseMail
{

    private $employee = null;
    private $password = null;

    public function __construct(Employee $employee, $password)
    {
        parent::__construct();
        $this->employee = $employee;
        $this->password = $password;
        $this->setting = Setting::firstOrFail();
    }

    public function build()
    {
        return parent::build()
            ->subject('Your account has been created')
            ->with('fullName', $this->employee->fullName)
            ->with('email', $this->employee->email)
            ->with('password', $this->password)
            ->with('website', $this->setting->website)
            ->view('emails.admin.employee_add', $this->viewData);
    }

}
