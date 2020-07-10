<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\LeaveType\CreateRequest;
use App\Http\Requests\Admin\LeaveType\DeleteRequest;
use App\Http\Requests\Admin\LeaveType\UpdateRequest;
use App\Models\Leavetype;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LeavetypesController
 * @package App\Http\Controllers\Admin
 */
class LeavetypesController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->attendanceOpen = 'active open';
        $this->pageTitle = 'LeaveType';
        $this->leaveTypeActive = 'active';
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->leaveTypes = Leavetype::all();
        return View::make('admin.leavetypes.index', $this->data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function ajaxLeaveType()
    {
        $result = Leavetype::select('id', 'leaveType', 'num_of_leave');

        return DataTables::of($result)
            ->addColumn('edit', function ($row) {
                return '<a class="btn btn-sm purple" onclick="showEdit(' . $row->id . ',\'' . $row->leaveType . '\',\'' . $row->num_of_leave . '\')">
                                        <i class="fa fa-edit"></i> View/Edit
                                    </a>
                                    <a class="btn btn-sm red" href="javascript:;"
                                      onclick="del(' . $row->id . ',\'' . $row->leaveType . '\')"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->escapeColumns(['edit'])
            ->make(false);
    }

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(CreateRequest $request)
    {
        Leavetype::create($request->toArray());

        return Reply::success('Leave Type added successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $this->leavetype = Leavetype::find($id);
        return View::make('admin.leavetypes.add-edit', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.leavetypes.add-edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $leavetype = Leavetype::findOrFail($id);
        $leavetype->update($request->toArray());
        return Reply::success('Leavetype updated successfully');
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Leavetype::destroy($id);

        return Reply::success('Delete SuccessFully');


    }

}
