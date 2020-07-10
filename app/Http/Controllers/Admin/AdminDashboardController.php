<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\Attendance;
use App\Models\Preassign;
use App\Models\Holiday;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

/**
 * Class AdminDashboardController
 * @package App\Http\Controllers\Admin
 */
class AdminDashboardController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->dashboardActive = 'active';
        $this->pageTitle = 'Dashboard';

    }

    public function index()
    {
        $today = date('Y-m-d');
        $md = substr($today, 5);
        if ($md == '01-01') {
          Preassign::all()->delete();
        }
        $this->holidays = Holiday::all();
        $attendance = Attendance::where(function ($query) {
            $query->where('application_status', '=', 'approved')
                ->orwhere('application_status', '=', null)
                ->orwhere('status', '=', 'present');
        })->get();

        $this->pending_applications = Attendance::where('application_status', '=', 'pending')->get();
        $at = [];
        $final = [];

        foreach ($attendance as $attend) {
            $at[$attend->date]['status'][] = $attend->status;
            $at[$attend->date]['employee'][] = $attend->employeeDetails->fullName;
            $at[$attend->date]['type'][] = $attend->leaveType;

        }

        foreach ($at as $index => $att) {

            if (in_array('absent', $att['status'])) {
                foreach ($att['employee'] as $index_emp => $employee) {
                    if ($att['status'][$index_emp] == 'absent') {
                        $final[$index][] = [
                            'fullName' => $employee,
                            'type' => $att['type'][$index_emp]
                        ];
                    }
                }

            } else {
                $final[$index][] = 'all present';
            }

        }

        $this->attendance = $final;


        // Expense Calculation
        $expense = DB::select(DB::raw("SELECT sum(price) as sum,m.month
     FROM (
           SELECT 1 AS MONTH
           UNION SELECT 2 AS MONTH
           UNION SELECT 3 AS MONTH
           UNION SELECT 4 AS MONTH
           UNION SELECT 5 AS MONTH
           UNION SELECT 6 AS MONTH
           UNION SELECT 7 AS MONTH
           UNION SELECT 8 AS MONTH
           UNION SELECT 9 AS MONTH
           UNION SELECT 10 AS MONTH
           UNION SELECT 11 AS MONTH
           UNION SELECT 12 AS MONTH
          ) AS m
LEFT JOIN `expenses` u
ON m.month = MONTH(purchaseDate)
   AND YEAR(purchaseDate) = YEAR(CURDATE())

GROUP BY m.month
ORDER BY month ;"));


        foreach ($expense as $ex) {
            $expensevalue[] = isset($ex->sum) ? $ex->sum : "''";
        }

        $this->expense = implode(',', $expensevalue);


        return View::make('admin/dashboard', $this->data);

    }

    /*    Screen lock controller.When screen lock button from menu is cliked this controller is called.
    *     lock variable is set to 1 when screen is locked.SET to 0  if you dont want screen variable
    */

    public function screenlock()
    {
        Session::put('lock', '1');
        return View::make('admin/screen_lock', $this->data);
    }


}

