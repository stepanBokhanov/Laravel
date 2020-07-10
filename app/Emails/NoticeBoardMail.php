<?php

namespace App\Emails;

use App\Models\Employee;
use App\Models\Setting;

class NoticeBoardMail extends BaseMail
{

    private $user = null;

    public function __construct(Employee $user)
    {
        parent::__construct();
        $this->user = $user;
        $this->setting = Setting::firstOrFail();
    }

    public function build()
    {
        return parent::build()
            ->subject('New Notice has been published')
            ->with('fullName', $this->user->fullName)
            ->with('email', $this->user->email)
            ->view('emails.admin.noticeboard', $this->viewData);
    }

}
