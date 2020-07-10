<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Events\LeaveRequestEvent;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\LeaveApplication\IndexRequest;
use App\Http\Requests\Admin\LeaveApplication\UpdateRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LeaveApplicationsController
 * @package App\Http\Controllers\Admin
 */
class LeaveApplicationsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
//        dd($this->setting);
        $this->leaveApplicationActive = 'active';
        $this->pageTitle = 'Leave Applications';
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $this->leave_applications = Attendance::all();
        return View::make('admin.leave_applications.index', $this->data);
    }

    // Datatable ajax request

    /**
     * @return mixed
     */
    public function ajaxApplications()
    {
        $result = Attendance::select('attendance.id', 'employees.fullName', 'attendance.date', 'attendance.leaveType', 'attendance.reason', 'attendance.applied_on', 'attendance.application_status', 'attendance.halfDayType', 'preassign.preassign_holidays')
            ->join('employees', 'employees.employeeID', '=', 'attendance.employeeID')
            ->join('preassign', 'employees.employeeID', '=', 'preassign.employeeID')
            ->whereNotNull('attendance.application_status')
            ->orderBy('attendance.applied_on', 'desc');

        return DataTables::of($result)
            ->editColumn('date', function ($row) {
                return date('d-M-Y', strtotime($row->date));
            })
            ->editColumn('preassign_holidays', function($row){
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
            ->removeColumn('halfDayType')
            ->addColumn('edit', function ($row) {
                return '<p><button  class="btn btn-sm purple" onclick="show_application(' . $row->id . ');return false;" ><i class="fa fa-edit"></i> View/Edit</button></p>
                          <p><a style="width: 106px;" href="javascript:;" onclick="del(' . $row->id . ');return false;" class="btn btn-sm red">
                        <i class="fa fa-trash"></i> Delete</a></p>';
            })
            ->escapeColumns(['edit', 'application_status'])
            ->make(false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $this->leave_application = Attendance::find($id);
        return View::make('admin.leave_applications.show', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->updated_by = Auth::guard('admin')->user()->email;

        $leaveApplication = Attendance::findOrFail($id);
        $leaveApplication->application_status = $request->application_status;
        $leaveApplication->save();
        // Send Email to All active users
        $attendance = Attendance::find($id);

        $this->attendance = $attendance;
        $employee = Employee::where('employeeID', '=', $attendance->employeeID)->first();
        $this->email = $employee->email;

        if ($this->setting->leave_notification == 1) {
            if ($leaveApplication->application_status != 'pending') {
                // TODO: Mail Implementation
                $attendanceDate = date('d-M-Y', strtotime($this->attendance->date));
                event(new LeaveRequestEvent($employee, $attendanceDate, $leaveApplication->application_status));
            }
        }

        return Reply::success('Leave Request updated successfully');
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        Attendance::destroy($id);
        return Reply::success('Deleted successfully');
    }

}
