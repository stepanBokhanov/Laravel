<?php
namespace App\Models;

/**
 * Class Setting
 * @package App\Models
 */
class Setting extends \Eloquent
{

    // Don't forget to fill this array
    protected $fillable = [
        'award_notification','notice_notification','attendance_notification','leave_notification','employee_add',
        'mail_host','mail_driver','mail_username','mail_encryption','mail_port','mail_password'];
    protected $guarded = ['id'];

    /**
     * @param int $size
     * @param string $d
     * @return \Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getLogoImageAttribute($size = 150, $d = 'mm')
    {
        if ($this->logo === 'default.jpg' || $this->logo === 'logo.png' || $this->logo == '' || $this->logo == null) {
            return $url = asset('assets/global/img/hrm-logo.png');
        }

        if (strpos($this->logo, 'https://') !== false) {
            return $image = str_replace('type=normal', 'type=large', $this->logo);
        }

        return asset_url('setting/logo/' . $this->logo, null);
    }

}
