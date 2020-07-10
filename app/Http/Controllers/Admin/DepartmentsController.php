<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Department\CreateRequest;
use App\Http\Requests\Admin\Department\IndexRequest;
use App\Http\Requests\Admin\Department\UpdateRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DepartmentsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->departmentOpen = 'active open';
        $this->pageTitle = 'Department';
    }

    /**
     * Display a listing of departments
     */
    public function index(IndexRequest $request)
    {
        $this->departments = Department::all();
        $this->departmentActive = 'active';
        $employeeCount = [];

        foreach (Department::all() as $dept) {
            $employeeCount[$dept->id] = Employee::join('designation', 'employees.designation', '=', 'designation.id')
                ->join('department', 'designation.deptID', '=', 'department.id')
                ->where('department.id', '=', $dept->id)
                ->count();
        }

        $this->employeeCount = $employeeCount;


        return View::make('admin.departments.index', $this->data);
    }

    public function ajaxDepartments()
    {
        $result = Department::select('id', 'deptName')->with('Designations');

        return datatables()->eloquent($result)
            ->addColumn('designation', function ($row) {
                $departmentData = '';

                foreach ($row->Designations as $desig) {
                    $departmentData .= '<li>   ' . $desig->designation . '</li>';
                }

                return $departmentData;
            })
            ->addColumn('action', function ($row) {
                return '<a class="btn btn-sm purple"  data-toggle="modal" onclick="showEdit(' . $row->id . ',\'' . $row->deptName . '\')"><i class="fa fa-edit"></i> View/Edit</a>

              						<a class="btn btn-sm red" onclick="del(' . $row->id . ',\'' . $row->deptName . '\')"><i class="fa fa-trash"></i> Delete</a>';

            })
            ->escapeColumns(['action', 'designation'])
            ->make(false);
    }

    /**
     * Store a newly created department in storage.
     */
    public function store(CreateRequest $request)
    {
        $dept = new Department();
        $dept->deptName = $request->deptName;
        $dept->save();

        foreach ($request->designation as $index => $value) {
            if ($value == '') continue;
            Designation::firstOrCreate([
                'deptID' => $dept->id,
                'designation' => $value
            ]);

        }

        return Reply::success('<strong>{$request->deptName}</strong> successfully added to the Database');
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit($id)
    {
        $this->department = Department::find($id);
        return View::make('admin.departments.edit', $this->data);
    }

    /**
     * Show the form for editing the specified department.
     */
    public function create()
    {
        return View::make('admin.departments.create', $this->data);
    }

    /**
     * Update the specified department in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $department = Department::findOrFail($id);

        $department->update([
            'deptName' => $request->deptName
        ]);

        foreach ($request->designation as $index => $value) {
            if ($value == '' && !isset($request->designationID[$index])) continue;

            if (isset($request->designationID[$index])) {
                if ($value == '') {
                    Designation::destroy($request->designationID[$index]);
                } else {
                    $design = Designation::find($request->designationID[$index]);
                    $design->designation = $value;
                    $design->save();
                }
            } else {
                Designation::firstOrCreate([
                    'deptID' => $department->id,
                    'designation' => $value
                ]);
            }

        }

        return Reply::success('<strong>{$request->deptName}</strong> updated successfully');
    }

    /**
     * Remove the specified department from storage.
     */
    public function destroy($id)
    {
        if (Request::ajax()) {
            Department::destroy($id);
            return Reply::success('Deleted Successfully');
        }
    }

    public function ajax_designation()
    {
        if (Request::ajax()) {
            $input = Input::get('deptID');
            $designation = Designation::where('deptID', '=', $input)
                ->get();

            return Response::json($designation, 200);
        }
    }

}
