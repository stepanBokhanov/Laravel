<?php
/**
 * Created by PhpStorm.
 * User: DEXTER
 * Date: 24/05/17
 * Time: 11:29 PM
 */

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Config;

trait SmtpSettings{

    public function setMailConfigs(){
        $setting = Setting::first();
        
        Config::set('mail.driver', $setting->mail_driver);
        Config::set('mail.host', $setting->mail_host);
        Config::set('mail.port', $setting->mail_port);
        Config::set('mail.username', $setting->mail_username);
        Config::set('mail.password', $setting->mail_password);
        Config::set('mail.encryption', $setting->mail_encryption);

        Config::set('app.name', $setting->website);

        (new MailServiceProvider(app()))->register();
    }

}
