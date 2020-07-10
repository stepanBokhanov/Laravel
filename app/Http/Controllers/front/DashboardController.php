<?php

namespace App\Http\Controllers\front;

use App\Classes\Reply;
use App\Events\ChangePasswordEvent;
use App\Events\LeaveRequestToAdminEvent;
use App\Http\Controllers\BaseController;
use App\Http\Requests\FrontUser\ChangePasswordRequest;
use App\Http\Requests\FrontUser\LeaveStoreRequest;
use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Preassign;
use App\Models\Award;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Leavetype;
use App\Models\Noticeboard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\front
 */
class DashboardController extends BaseController
{

    public function __construct()
    {

        parent::__construct();

        $this->middleware(function ($request, $next) {

            $this->pageTitle = 'Dashboard';

            $this->employeeID = Auth::guard('employees')->user()->employeeID;

            $this->leaveTypes = Attendance::leaveTypesEmployees();
            $this->leaveTypeWithoutHalfDay = Attendance::leaveTypesEmployees('halfday');
            // Total leaves except
            $totalLeave = Leavetype::where('leaveType', '<>', 'half day')->sum('num_of_leave');

            $this->leaveLeft = array_sum(Attendance::absentEmployee($this->employeeID)) . '/' . $totalLeave;

            $this->employee = Employee::find(Auth::guard('employees')->user()->id);

            $this->holidays = Holiday::orderBy('date', 'ASC')->limit('10')->where('date','>',Carbon::now())->get();

            $this->awards = Award::select('*')->orderBy('created_at', 'desc')->get();

            $this->attendance = Attendance::where('employeeID', '=', $this->employeeID)
                ->where(function ($query) {
                    $query->where('application_status', '=', 'approved')
                        ->orWhere('application_status', '=', null)
                        ->orWhere('status', '=', 'present');
                })
                ->get();

            $this->attendance_count = Attendance::attendanceCount($this->employeeID);

            $this->current_month_birthdays = Employee::currentMonthBirthday();

            return $next($request);
        });

    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $this->homeActive = 'active';
        $this->noticeboards = Noticeboard::where('status', '=', 'active')->orderBy('created_at', 'DESC')->get();
        $this->userAwards = user()->getAwards;

        $this->holiday_color = ['info', 'error', 'success', 'pending', ''];
        $this->holiday_font_color = ['blue', 'red', 'green', 'yellow', 'dark'];


        return View::make('front.employeeDashboard', $this->data);
    }

    // Show leave Page

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function leave()
    {
        $this->leaveActive = 'active';

        $this->attendance = Attendance::where('employeeID', '=', $this->employeeID)->get();

        return View::make('front.leave', $this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function notice_ajax($id)
    {
        $notice = Noticeboard::find($id);
        $output['title'] = $notice->title;
        $output['description'] = $notice->description;

        return Response::json($output, 200);
    }

    // Submitting the leave request from Employee

    /**
     * @param LeaveStoreRequest $request
     * @return array
     */
    public function leave_store(LeaveStoreRequest $request)
    {
        foreach ($request->date as $index => $value) {

            if (empty($value)) continue;
            try {
                if (!Preassign::where('employeeID', $this->employeeID)->exists()) {
                    return Reply::error('<strong>Error!</strong>  You can\'t apply leave because 0 holiday left.');
                }
                if (Preassign::where('employeeID', $this->employeeID)->first()->preassign_holidays == 0) {
                    return Reply::error('<strong>Error!</strong>  You can\'t apply leave because 0 holiday left.');
                }
                Attendance::create([
                    'employeeID' => $this->employeeID,
                    'date' => date('Y-m-d', strtotime($value)),
                    'status' => 'absent',
                    'leaveType' => $request->leaveType[$index],
                    'halfDayType' => ($request->leaveType[$index] == 'half day') ? $request->halfleaveType[$index] : null,
                    'reason' => $request->reason[$index],
                    'application_status' => 'pending',
                    'applied_on' => date('Y-m-d', time())
                ]);
                $pre = Preassign::where('employeeID', $this->employeeID)->first();
                $pre->preassign_holidays -= 1;
                $pre->save();
                $dates[$index] = date('d-M-Y', strtotime($value));
                $leaveType[$index] = $request->leaveType[$index];
                $reason[$index] = $request->reason[$index];

            } catch (\Exception $e) {

                return Reply::error('<strong>Error!</strong> You have already applied leave for the particular date');
            }

        }

        // Send email to all admins
        $admins = Admin::select('id', 'email')->get();

        foreach ($admins as $admin) {
            // TODO::mail implementation
            event(new LeaveRequestToAdminEvent($admin, $this->setting->website, $dates, $leaveType, $reason));
        }

        Session::flash('success_leave', '<strong>Success!</strong> Leave request is send to the HR Manger.You will be notified soon.');
        return Reply::redirect(route('front.leave'), '<strong>Success!</strong> Leave request is send to the HR Manger.You will be notified soon.');

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxApplications()
    {

        $result = Attendance::select('id', 'date', 'leaveType', 'reason', 'applied_on', 'application_status', 'halfDayType', 'preassign_holidays')
            ->where('employeeID', '=', $this->employeeID)
            ->whereNotNull('application_status')
            ->orderBy('applied_on', 'desc');

        $result = Attendance::select('attendance.id', 'attendance.date', 'attendance.leaveType', 'attendance.reason', 'attendance.applied_on', 'attendance.application_status', 'attendance.halfDayType', 'preassign.preassign_holidays')
            ->join('preassign', 'attendance.employeeID', '=', 'preassign.employeeID')
            ->where('attendance.employeeID', $this->employeeID)
            ->whereNotNull('attendance.application_status')
            ->orderBy('attendance.applied_on', 'desc');

        return datatables()->eloquent($result)
            ->editColumn('date', function ($row) {
                return date('d-M-Y', strtotime($row->date));
            })
            ->editColumn('preassign_holidays', function ($row) {
                return $row->preassign_holidays.'<p>days left.</p>';
            })
            ->editColumn('applied_on', function ($row) {
                return date('d-M-Y', strtotime($row->applied_on));
            })
            ->editColumn('leaveType', function ($row) {
                $leave = ($row->leaveType == 'half day') ? $row->leaveType . '-' . $row->halfDayType : $row->leaveType;
                return $leave;
            })
            ->editColumn('reason', function ($row) {
                return strip_tags(\Illuminate\Support\Str::limit($row->reason, 50));

            })
            ->editColumn('application_status', function ($row) {
                $color = [
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger'
                ];

                return '<span class="label label-' . $color[$row->application_status] . '">' . $row->application_status . '</span>';
            })
            ->addColumn('edit', function ($row) {
                return '<button  class="btn-u btn-u-blue" data-toggle="modal" data-target=".show_notice" onclick="show_application(' . $row->id . ');return false;" ><i class="fa fa-eye"></i> View</button>';
            })
            ->escapeColumns(['edit', 'application_status'])
            ->removeColumn('halfDayType')
            ->make(false);
    }

    public function changePasswordModal()
    {
        return View::make('front.change_password_modal', $this->data);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $employee = Auth::guard('employees')->user();
        $employee->password = $request->password;
        $employee->save();

        event(new ChangePasswordEvent($employee));

        return Reply::success('Password changed successfully');


    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $this->leave_application = Attendance::find($id);
        return View::make('front.leave_modal_show', $this->data);
    }



}
