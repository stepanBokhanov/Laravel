<?php

namespace App\Emails;

use App\Models\Employee;
use App\Models\Setting;

/**
 * Class AwardMail
 * @package App\Emails
 */
class AwardMail extends BaseMail
{

    private $employee = null;
    private $awardName = null;

    public function __construct(Employee $employee, $awardName)
    {
        parent::__construct();
        $this->employee = $employee;
        $this->awardName = $awardName;
        $this->setting = Setting::firstOrFail();
    }

    public function build()
    {
        return parent::build()
            ->subject('Award - '.$this->awardName)
            ->with('fullName', $this->employee->fullName)
            ->with('awardName', $this->awardName)
            ->view('emails.admin.award', $this->viewData);
    }

}
