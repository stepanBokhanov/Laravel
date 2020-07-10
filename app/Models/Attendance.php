<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Attendance extends \Eloquent
{
    // Don't forget to fill this array
    protected $fillable = [];

    protected $table = 'attendance';
    protected $guarded = ['id'];

    // Get employee Details

    /**
     * @return mixed
     */
    public function employeeDetails()
    {

        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }

    // Total number of Day the employee  present

    /**
     * @param $month
     * @param $year
     * @param $employeeID
     * @return int
     */
    public static function countPresentDays($month, $year, $employeeID)
    {
        $fullday = count(DB::select(DB::raw("select * from attendance where YEAR(date)=" . $year . "
	                                            AND MONTH(date)=" . $month . " AND status='present'
	                                            AND employeeID='$employeeID'")));

        $halfday = count(DB::select(DB::raw("select * from attendance where YEAR(date)=" . $year . "
			                                    AND MONTH(date)=" . $month . " AND status='absent' AND leaveType='half day'
			                                    AND (application_status IS NULL OR application_status='approved')
			                                    AND employeeID='$employeeID'")));
        return ($fullday + $halfday / 2);
    }

    public static function leaveTypesEmployees($method = 'all')
    {
        $leaveTypes = [];
        $leaveTypeWithouthalfDay = [];

        foreach (Leavetype::all() as $leave) {
            $leaveTypes[$leave->leaveType] = $leave->leaveType;

            if ($leave->leaveType != 'half day') {
                $leaveTypeWithouthalfDay[$leave->leaveType] = $leave->leaveType;
            }
        }

        if ($method == 'all') {
            return $leaveTypes;
        }
        else {
            return $leaveTypeWithouthalfDay;
        }

    }

    // Function for counting the current month present
    /**
     * @param $employeeID
     * @return string
     */

    public static function attendanceCount($employeeID)
    {
        // Calculating Attendance
        $date = date('d');
        $month = date('m');
        $year = date('Y');
        $firstDay = $year . '-' . $month . '-' . $date;

        $presentCount = Attendance::countPresentDays($month, $year, $employeeID);

        $totalDays = date('t', strtotime($firstDay));

        $holidayCount = count(DB::select(DB::raw("select * from holidays where MONTH(date)=" . $month)));
        $workingDays = $totalDays - $holidayCount;

        return ($presentCount / $workingDays);
    }

    // Function to count the total leaves taken
    /**
     * @param $employeeID
     * @return mixed
     */
    public static function absentEmployee($employeeID)
    {
        $half = 0;
        foreach (Leavetype::all() as $leave)
        {
            // Half Day leaves are added to casual leaves.2 half days are equal to one Casual Leave
            if ($leave->leaveType == 'half day') {
                $halfDay = Attendance::where('status', '=', 'absent')
                    ->where(function ($query) {
                        $query->where('application_status', '=', 'approved')
                            ->orWhere('application_status', '=', null);
                    })
                    ->where('employeeID', '=', $employeeID)
                    // For unpaid Leaves
                    ->where('halfDayType', '<>', 'unpaid')
                    ->where('leaveType', '=', $leave->leaveType)->count();

                // Added to casual
                $half += $halfDay / 2;

            } else {
                $absent[$leave->leaveType] = Attendance::where('status', '=', 'absent')
                    ->where(function ($query) {
                        $query->where('application_status', '=', 'approved')
                            ->orWhere('application_status', '=', null);
                    })
                    ->where('employeeID', '=', $employeeID)
                    // For Unpaid Leaves
                    ->where('leaveType', '<>', 'unpaid')
                    ->where('leaveType', '=', $leave->leaveType)
                    ->count();

            }


        }

        $absent['half day'] = $half;
        return $absent;
    }

    public static function absentEveryEmployee()
    {
        $employees = Employee::active()->get();
        $absentess = [];

        foreach ($employees as $employee)
        {
            // Count the absent except half days
            foreach (Leavetype::where('leaveType', '<>', 'half day')->get() as $leave) {
                //$absentess[$employee->employeeID][$leave->leaveType] = 0;
                // Half Day leaves are added to casual leaves.2 half days are equal to one Casual Leave

                $absentess[$employee->employeeID][$leave->leaveType] = Attendance::where('status', '=', 'absent')
                    ->where('employeeID', '=', $employee->employeeID)
                    ->where(function ($query) {
                        $query->where('application_status', '=', 'approved')
                            ->orWhere('application_status', '=', null);
                    })
                    ->where('leaveType', '=', $leave->leaveType)->count();

            }


            // half days count
            foreach (Leavetype::where('leaveType', '=', 'half day')->get() as $leave) {
                $halfDay = Attendance::select('halfDayType', DB::raw('count(*) as total'))
                    ->where('status', '=', 'absent')
                    ->where('employeeID', '=', $employee->employeeID)
                    ->where(function ($query) {
                        $query->where('application_status', '=', 'approved')
                            ->orWhere('application_status', '=', null);
                    })
                    ->where('leaveType', '=', $leave->leaveType)
                    ->groupBy('halfDayType')
                    ->get();

                foreach ($halfDay as $half) {
                    $absentess[$employee->employeeID][$half->halfDayType] += $half->total / 2;
                }


            }

            // Total of All leaves
            $absentess[$employee->employeeID]['total'] = array_sum($absentess[$employee->employeeID]);
        }

        return $absentess;
    }

}