<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Salary\CreateRequest;
use App\Models\Salary;
use Illuminate\Support\Facades\View;

/**
 * Class SalaryController
 * @package App\Http\Controllers\Admin
 */
class SalaryController extends AdminBaseController
{

    /**
     * @param CreateRequest $request
     * @return array
     */
    public function store(CreateRequest $request)
    {
        $input = $request->all();

        $salary = Salary::create($input);
        $viewData = '<div id="salary' . $salary->id . '">
                          <div class="form-group">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="type[' . $salary->id . ']" value="' . $salary->type . '">
                                 </div>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="salary[' . $salary->id . ']" value="' . $salary->salary . '">
                                </div>

                                <div class="col-md-2">
                                    <a class="btn btn-sm red" onclick="del(' . $salary->id . ',\'' . $salary->type . '\')"><i class="fa fa-trash"></i> </a>
                                </div>
                            </div>
                        </div>';
        return Reply::successWithData( 'Salary Created successfully', ['viewData' => $viewData]);
    }

    /**
     * @param $id
     */
    public function update($id)
    {
        //
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $employeeID
     * @return \Illuminate\Contracts\View\View
     */
    public function addSalaryModal($employeeID)
    {
        $this->employeesActive = 'active';
        $this->employeeID = $employeeID;

        return View::make('admin.employees.salary-show-modal', $this->data);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        Salary::destroy($id);
        return Reply::success('Salary Deleted successfully');
    }

}
