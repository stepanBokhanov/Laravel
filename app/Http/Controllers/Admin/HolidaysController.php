<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\Holiday\CreateRequest;
use App\Http\Requests\Admin\Holiday\DeleteRequest;
use App\Http\Requests\Admin\Holiday\IndexRequest;
use App\Http\Requests\Admin\Holiday\UpdateRequest;
use App\Http\Requests\Admin\Holiday\PreassignRequest;
use App\Models\Holiday;
use App\Models\Preassign;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class HolidaysController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->holidayOpen = 'active open';
        $this->pageTitle = 'Holiday';

        for ($m = 1; $m <= 12; $m++) {
            $month[] = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
        }

        $this->months = $month;
        $this->currentMonth = date('F');
    }

    public function index(IndexRequest $request)
    {
        $this->holidays = Holiday::orderBy('date', 'ASC')->get();;
        $this->holidayActive = 'active';
        $hol = [];

        $year = Carbon::now()->format('Y');
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 0);
        $this->number_of_sundays = count($dateArr);

        $this->holidays_in_db = count($this->holidays);

        foreach ($this->holidays as $holiday) {
            $hol[date('F', strtotime($holiday->date))]['id'][] = $holiday->id;
            $hol[date('F', strtotime($holiday->date))]['date'][] = date('d F Y', strtotime($holiday->date));
            $hol[date('F', strtotime($holiday->date))]['ocassion'][] = $holiday->occassion;
            $hol[date('F', strtotime($holiday->date))]['day'][] = date('D', strtotime($holiday->date));
        }

        $this->holidaysArray = $hol;
        $this->employees = Employee::all();

        return View::make('admin.holidays.index', $this->data);
    }

    /**
     * Show the form for creating a new holiday
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.holidays.create');
    }

    /**
     * Store a newly created holiday in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        Cache::forget('holiday_cache');

        $holiday = array_combine($request->date, $request->occasion);

        foreach ($holiday as $index => $value) {
            if ($index == '') continue;
            $add = Holiday::firstOrCreate([
                'date' => date('Y-m-d', strtotime($index)),
                'occassion' => $value,

            ]);
        }

        return Reply::redirect(route('admin.holidays.index'), '<strong>New Holidays</strong> successfully added to the Database');
    }

    /**
     * Display the specified holiday.
     */
    public function show($id)
    {
        $holiday = Holiday::findOrFail($id);

        return View::make('admin.holidays.show', compact('holiday'));
    }

    /**
     * Show the form for editing the specified holiday.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $holiday = Holiday::find($id);

        return View::make('admin.holidays.edit', compact('holiday'));
    }

    /**
     * Update the specified holiday in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        Cache::forget('holiday_cache');
        $holiday = Holiday::findOrFail($id);
        $data = Input::all();
        $holiday->update($data);

        return Redirect::route('admin.holidays.index');
    }

    /**
     * Remove the specified holiday from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(DeleteRequest $request, $id)
    {
        Holiday::destroy($id);
        Cache::forget('holiday_cache');
        return Reply::success('Deleted successfully');
    }

    /**
     * @return array
     */

    public function Friday()
    {
        Cache::forget('holiday_cache');

        $year = Carbon::now()->format('Y');
        $dateArr = $this->getDateForSpecificDayBetweenDates($year . '-01-01', $year . '-12-31', 5);

        foreach ($dateArr as $date) {
            Holiday::firstOrCreate([
                'date' => $date,
                'occassion' => 'Friday'
            ]);
        }

        return Reply::redirect(route('admin.holidays.index'), '<strong>All Fridays</strong> successfully added to the Database');
    }

    public function preassign(PreassignRequest $request)
    {
        $employee = $request->emp_id;
        $pre_holiday = $request->preassigned;
        if ($employee == 0) {
            $employees = Employee::all();
            foreach ($employees as $row) {
                if(Preassign::where('employeeID', $row->employeeID)->exists()){
                    $preassign = Preassign::where('employeeID', $row->employeeID)->first();
                    $preassign->preassign_holidays = $pre_holiday;
                    $preassign->save();
                }
                else {
                    $preassign = new Preassign;
                    $preassign->employeeID = $row->employeeID;
                    $preassign->preassign_holidays = $pre_holiday;
                    $preassign->save();  
                }
            }
        }
        else{
            if (Preassign::where('employeeID', Employee::find($employee)->employeeID)->exists()) {
                $preassign = Preassign::where('employeeID', Employee::find($employee)->employeeID)->first();
                $preassign->preassign_holidays = $pre_holiday;
                $preassign->save();
            }
            else{
                $preassign = new Preassign;
                $preassign->employeeID = Employee::find($employee)->employeeID;
                $preassign->preassign_holidays = $pre_holiday;
                $preassign->save();
            }
            
        }
        return Reply::success('successfully preassigned');
    }
    /**
     * @param $startDate
     * @param $endDate
     * @param $weekdayNumber
     * @return array
     */
    public function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        $dateArr = [];

        do {
            if (date('w', $startDate) != $weekdayNumber) {
                $startDate += (24 * 3600); // add 1 day
            }
        } while (date('w', $startDate) != $weekdayNumber);


        while ($startDate <= $endDate) {
            $dateArr[] = date('Y-m-d', $startDate);
            $startDate += (7 * 24 * 3600); // add 7 days
        }

        return ($dateArr);
    }

}
