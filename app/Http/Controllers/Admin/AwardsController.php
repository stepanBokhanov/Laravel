<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Events\AwardEvent;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Award\CreateRequest;
use App\Http\Requests\Admin\Award\DeleteRequest;
use App\Http\Requests\Admin\Award\IndexRequest;
use App\Http\Requests\Admin\Award\UpdateRequest;
use App\Models\Award;
use App\Models\Employee;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class AwardsController
 * @package App\Http\Controllers\Admin
 */
class AwardsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Awards';
        $this->awardsActive = 'active';
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $this->awards = Award::all();

        return View::make('admin.awards.index', $this->data);
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajax_awards()
    {
        $result = Award::select('awards.id', 'awards.employeeID', 'employees.fullName', 'awards.awardName', 'awards.gift', 'awards.forMonth', 'awards.forYear')
            ->join('employees', 'awards.employeeID', '=', 'employees.employeeID');

        return DataTables::of($result)
            ->addColumn('For Month', function ($row) {
                return ucfirst($row->forMonth) . ' ' . $row->forYear;
            })
            ->addColumn('edit', function ($row) {
                return '<a  class="btn btn-sm purple"  href="' . route('admin.awards.edit', $row->id) . '" ><i class="fa fa-edit"></i> View/Edit</a>
                            &nbsp;<a href="javascript:;" onclick="del(' . $row->id . ',\'' . $row->fullName . '\',\'' . $row->awardName . '\');return false;" class="btn btn-sm red">
                        <i class="fa fa-trash"></i> Delete</a>';
            })
            ->escapeColumns(['edit'])
            ->removeColumn('forYear')
            ->make(false);
    }

    public function create()
    {

        $this->employees = Employee::selectRaw('CONCAT(fullName, " (EmpID:", employeeID,")") as full_name, employeeID')
            ->where('status', '=', 'active')
            ->pluck('full_name', 'employeeID');

        return View::make('admin.awards.create', $this->data);
    }

    public function show($id)
    {
        $this->award = Award::select(['id','awardName','gift','cashPrice','forMonth','forYear'])->find($id);

        return View::make('front.award-detail', $this->data);
    }

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(CreateRequest $request)
    {
        if ($this->setting->award_notification == 1) {
            $employee = Employee::select('id', 'email', 'fullName')->where('employeeID', '=', $request->employeeID)->first();

            // Send award Mail
            event(new AwardEvent($employee, $request->awardName));
        }

        Award::create($request->toArray());

        return Reply::redirect(route('admin.awards.index'), '<strong>{$request->awardName}</strong> is awarded');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->award = Award::find($id);
        $this->employees = Employee::pluck('fullName', 'employeeID');
        return View::make('admin.awards.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $award = Award::findOrFail($id);

        $award->update($request->toArray());

        return Reply::redirect(route('admin.awards.index'), '<strong>Success</strong> Updated Successfully');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Award::destroy($id);
        return Reply::success('Award deleted successfully');

    }

}
