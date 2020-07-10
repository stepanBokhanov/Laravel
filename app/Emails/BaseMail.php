<?php

namespace App\Emails;

use App\Models\Setting;
use App\Traits\SmtpSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseMail extends Mailable
{

    use Queueable, SerializesModels,SmtpSettings;

    protected $setting = null;
    // These are timezones in order they are listed in Select box in school settings
    // on front-end. So, we can get school's correct timezone from timezone_position setting

    public function __construct()
    {
        $this->setMailConfigs();
    }

    public function build()
    {

        $setting = $this->setting;

        $fromMail = (empty($setting->email)) ? env('FROM_EMAIL') : $setting->email;
        $fromName = (empty($setting->name)) ? env('FROM_NAME') : $setting->name;
        $address  = (empty($setting->localAddress)) ? '' : $setting->localAddress;


        return $this->from($fromMail, $fromName)
            ->replyTo($fromMail, $fromName)
            ->with('companyName', $fromName)
            ->with('address', $address)
            ->with('setting', $setting);
    }
    
}
