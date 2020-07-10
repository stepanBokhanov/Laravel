<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Files;
use App\Classes\Reply;
use App\Events\CreateEmployeeEvent;
use App\Exports\EmployeeExport;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Employee\CreateRequest;
use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Models\Bank_detail;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Employee_document;
use App\Models\Salary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

/**
 * Class EmployeesController
 * This Controller is for the all the related function applied on employees
 */
class EmployeesController extends AdminBaseController
{

    /**
     * Constructor for the Employees
     */

    public function __construct()
    {
        parent::__construct();
        $this->employeesOpen = 'active open';
        $this->pageTitle = 'Employees';
        $this->employeesActive = 'active';
    }

    public function index()
    {
        return View::make('admin.employees.index', $this->data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajaxEmployees()
    {
        $result = Employee::select('id', 'employeeID', 'profileImage', 'email', 'fullName', 'designation', 'date_of_birth', 'status');
                    // ->with('getDesignation:id,deptID,designation');

        return datatables()->eloquent($result)
            ->filter(function($query) {
                if(request()->search['value']) {
                    $query->where('employeeID', 'LIKE', '%'.request()->search['value'].'%')
                            ->orWhere('email', 'LIKE', '%'.request()->search['value'].'%')
                            ->orWhere('fullName', 'LIKE', '%'.request()->search['value'].'%')
                            ->orWhereHas('getDesignation', function($q) {
                                $q->where('designation', 'LIKE', '%'.strtolower(request()->search['value']).'%');
                                // ->orWhereHas('department', function($q1) {
                                //     $q1->where('deptName', 'LIKE', '%'.strtolower(request()->search['value']).'%');
                                // });
                            });
                }
            })
            ->editColumn('profileImage', function ($row) {
                return '<img src="' . $row->profile_image_url . '" height="80px" />';
            })
            ->editColumn('designation', function ($row) {
                return '<p>Department: <strong>' . $row->getDesignation->department->deptName . '</strong></p>
                <p>Designation: <strong>' . $row->getDesignation->designation . '</strong></p>';
            })
            ->editColumn('date_of_birth', function ($row) {
                return $row->workDuration($row->employeeID);

            })
            ->editColumn('status', function ($row) {
                $color = [
                    'active' => 'success',
                    'inactive' => 'danger'
                ];

                return '<span class="label label-' . $color[$row->status] . '">' . $row->status . '</span>';

            })
            ->addColumn('action', function ($row) {
                return '<p> <a class="btn btn-sm purple" href="' . route('admin.employees.edit', $row->employeeID) . '"><i class="fa fa-edit"></i> View/Edit</a></p>
                                    <p>    <a class="btn btn-sm red" style="width: 90px;" href="javascript:;" onclick="del(\'' . $row->id . '\')"><i class="fa fa-trash"></i> Delete</a></p>';
            })
            ->escapeColumns(['designation', 'action', 'status', 'profileImage'])
            ->removeColumn('halfDayType', 'profile_image_url')
            ->removeColumn('email', 'id')
            ->make(false);
    }

    /**
     * Show the form for creating a new employee
     */
    public function create()
    {
        $this->department = Department::pluck('deptName', 'id');

        return View::make('admin.employees.create', $this->data);
    }

    /**
     * @param CreateRequest $request
     * @return array
     * @throws \Exception
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();
        try {

            $employee = Employee::create($request->toArray());

            // Profile Image Upload
            if ($request->profileImage) {
                $file = new Files();
                $employee->profileImage = $file->upload($request->profileImage, 'employee');
                $employee->save();
            }

            // Insert into salary table
            if ($request->currentSalary != '') {
                Salary::create([
                    'employeeID' => $request->employeeID,
                    'type' => 'current',
                    'remarks' => 'Joining Salary Of Employee',
                    'salary' => $request->currentSalary

                ]);
            }

            // Insert Into Bank Details
            if ($request->accountName != '' && $request->accountNumber != '') {
                Bank_detail::create($request->toArray());
            }

            // UPLOAD THE DOCUMENTS  -----------------
            $documents = ['resume', 'offerLetter', 'joiningLetter', 'contract', 'IDProof'];

            foreach ($documents as $document) {

                if ($request->hasFile($document)) {
                    $file = new Files();
                    $filename = $file->upload(Input::file($document), 'employee_documents/' . $document, null, null, false);
                    Employee_document::create([
                        'employeeID' => $request->employeeID,
                        'fileName' => $filename,
                        'type' => $document
                    ]);
                }
            }


            if ($this->setting->employee_add == 1) {
                $this->employee_name = $request->fullName;
                $this->employee_email = $request->email;
                $this->employee_password = $request->password;
                // Send Employee Add Mail
                event(new CreateEmployeeEvent($employee, $request->password));
            }

            // END UPLOAD THE DOCUMENTS**********

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        return Reply::redirect(route('admin.employees.index'), '</strong> successfully added to the Database');
    }

    /**
     * Show the form for editing the specified employee
     */
    public function edit($id)
    {
        $this->employeesActive = 'active';
        $this->department = Department::pluck('deptName', 'id');
        $this->employee = Employee::where('employeeID', '=', $id)->get()->first();
        $this->designation = Designation::find($this->employee->designation);

        $doc = [];

        foreach ($this->employee->getDocuments as $documents) {
            $doc[$documents->type] = $documents->document_url;
        }

        $this->documents = $doc;

        $this->bank_details = Bank_detail::where('employeeID', '=', $id)->get()->first();

        return View::make('admin.employees.edit', $this->data);
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        // Bank Details Update-------
        if ($request->updateType == 'bank') {
            $bankDetails = Bank_detail::firstOrNew(['employeeID' => $id]);
//            $bankDetails->update($request->toArray());
            $bankDetails->accountName = $request->accountName;
            $bankDetails->accountNumber = $request->accountNumber;
            $bankDetails->bank = $request->bank;
            $bankDetails->pan = $request->pan;
            $bankDetails->ifsc = $request->ifsc;
            $bankDetails->branch = $request->branch;
            $bankDetails->save();

            return Reply::success('Bank details updated successfully');

        }

        // Bank Details Update End--------
        // Company Details Update Start--------

        else if ($request->updateType == 'company') {
            $companyDetails = Employee::where('employeeID', '=', $id)->first();

            $companyDetails->employeeID = $request->employeeID;
            $companyDetails->designation = $request->designation;
            $companyDetails->joiningDate = date('Y-m-d', strtotime($request->joiningDate));
            $companyDetails->exit_date = (trim($request->exit_date) != '') ? date('Y-m-d', strtotime($request->exit_date)) : null;

            $companyDetails->status = ($request->status != 'active') ? 'inactive' : 'active';
            $companyDetails->save();

            if (isset($request->salarysalary)) {
                foreach ($request->salary as $index => $value) {
                    $salaryDetails = Salary::find($index);
                    $salaryDetails->type = $request->type[$index];
                    $salaryDetails->salary = $value;
                    $salaryDetails->save();
                }
            }

            return Reply::success('Company Details updated successfully');

        }

        // Company Details Update End--------------


        // Personal info Details Update Start----------

        else if ($request->updateType == 'personalInfo') {
            $employee = Employee::where('employeeID', '=', $id)->get()->first();

            // Profile Image Upload
            if ($request->profileImage) {
                $file = new Files();
                $filename = $file->upload($request->profileImage, 'employee');
            } else {
                $filename = $request->hiddenImage;
            }

            $employee->update($request->toArray());

            $employee->profileImage = $filename;

            if($request->new_password != ''){
                $employee->password = $request->new_password;
            }

            $employee->save();


            return Reply::success('Updated Successfully');
        }

        // Personal Details Update End-------------

        // Documents info Details Update Start--------
        else if ($request->updateType == 'documents') {
            // UPLOAD THE DOCUMENTS  -----------------
            $documents = ['resume', 'offerLetter', 'joiningLetter', 'contract', 'IDProof'];

            foreach ($documents as $document) {

                if (Input::hasFile($document)) {
                    $file = new Files();
                    $filename = $file->upload(Input::file($document), 'employee_documents/' . $document, null, null, false);
                    $employeeDocument = Employee_document::firstOrNew(['employeeID' => $id, 'type' => $document]);
                    $employeeDocument->fileName = $filename;
                    $employeeDocument->type = $document;
                    $employeeDocument->save();
                }
            }

            return Reply::success('<strong>Success</strong> Updated Successfully');
            // END UPLOAD THE DOCUMENTS**********

        }

        // Documents info Details Update END--------

    }

    // Export Employee Data

    public function export()
    {
        $fileName = 'Employees-' . time() . '.xlsx';
        if (request()->filled('s')) {
            return (new EmployeeExport(request()->input('s')))->download($fileName);
        }
        return (new EmployeeExport)->download($fileName);
    }

    /**
     * @param $id
     * @return array
     * Delete Employee Completely
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return Reply::success('messages.successDelete');
    }

}
