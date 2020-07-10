<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Hash;

class Employee extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    // Don't forget to fill this array
    protected $fillable = ['employeeID','designation','fullName','fatherName','gender','email','password','date_of_birth','mobileNumber','localAddress','profileImage','joiningDate','permanentAddress'];
    protected $guarded = ['id'];

    protected $hidden = ['password'];
    protected $appends = ['profile_image_url'];

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->hasMany(Employee_document::class, 'employeeID', 'employeeID');
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->hasMany(Salary::class, 'employeeID', 'employeeID');
    }

    /**
     * @return mixed
     */
    public function getAwards()
    {
        return $this->hasMany(Award::class, 'employeeID', 'employeeID')->select(['id','awardName','forMonth','forYear']);
    }

    /**
     * @return mixed
     */
    public function getBankDetail()
    {
        return $this->belongsTo(Bank_detail::class, 'employeeID', 'employeeID');
    }

    public function getAttendance()
    {
        return $this->hasMany(Attendance::class, 'employeeID', 'employeeID');
    }

    public function getPreassign()
    {
        return $this->hasMany(Preassign::class, 'employeeID', 'employeeID');
    }


    /**
     * @return mixed
     */
    public static function currentMonthBirthday()
    {
        $birthdays = Employee::select('fullName', 'date_of_birth', 'profileImage')
            ->whereRaw("MONTH(date_of_birth) = ?", [date('m')])
            ->where('status', '=', 'active')
            ->orderBy('date_of_birth', 'asc')
            ->get();
        return $birthdays;
    }

    // Function to calculate number of days of work
    /**
     * @param $employeeID
     * @return null|string
     */

    public function workDuration($employeeID)
    {
        $employee = Employee::select('joiningDate', 'exit_date')->where('employeeID', '=', $employeeID)->first();
        $lastDate = ($employee->exit_date == NULL) ? date('Y-m-d') : $employee->exit_date;

        $diff = date_diff(date_create($employee->joiningDate), date_create($lastDate));

        $difference = ($diff->y == 0) ? null : $diff->y . ' year ';
        $difference .= ($diff->m == 0) ? null : $diff->m . ' month ';
        $difference .= ($diff->d == 0) ? null : $diff->d . ' day ';

        return $difference;

    }

    /**
     * Get the last absent days
     * If the user is not absent since joining then.Joining date is last absent date
     */
    public function lastAbsent($employeeID, $type = 'days')
    {
        $absent = Attendance::where('status', '=', 'absent')
            ->where('employeeID', '=', $employeeID)
            ->where(function ($query) {
                $query->where('application_status', '=', 'approved')
                    ->orWhere('application_status', '=', null);
            })->orderBy('date', 'desc')->first();

        $joiningDate = Employee::select('joiningDate')->where('employeeID', '=', $employeeID)->first();

        $lastDate = date('Y-m-d');
        $old_date = isset($absent->date) ? $absent->date : $joiningDate->joiningDate;
        $diff = date_diff(date_create($old_date), date_create($lastDate));

        $difference = $diff->format('%R%a') . ' day ago';

        if ($type == 'days') {
            return $difference;
        }
        elseif ($type == 'date') {
            return date_create($old_date)->format('d-M-Y');
        }

    }

    /**
     * @param int $size
     * @param string $d
     * @return \Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getProfileImageUrlAttribute()
    {

        $size =250;
        $d='mm';
        if ($this->profileImage === 'default.jpg' || $this->profileImage == '' || $this->profileImage == null) {
            return $url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=' . $d . '&s=' . $size;
        }

        if (strpos($this->profileImage, 'https://') !== false) {
            return $image = str_replace('type=normal', 'type=large', $this->profileImage);
        }

        return asset_url('employee/' . $this->profileImage, null);

    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function setFullNameAttribute($value){
        $this->attributes['fullName'] = ucwords(strtolower($value));
    }

    public function setFatherNameAttribute($value){
        $this->attributes['fatherName'] = ucwords(strtolower($value));
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = date('Y-m-d', strtotime($value));
    }

    public function setJoiningDateAttribute($value)
    {
        $this->attributes['joiningDate'] = date('Y-m-d', strtotime($value));
    }

}
