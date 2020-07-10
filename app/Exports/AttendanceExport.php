<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;
use App\Models\Employee;

class AttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{

    use Exportable;

    private $employees;

    public function __construct(string $searchValue = null)
    {
        $this->employees = Employee::select('id', 'employeeID', 'fullName')
            ->with(['getAttendance' => function ($q) {
                $q->select('id', 'employeeID', 'date', 'status', 'leaveType')
                    ->whereBetween('date', [Carbon::parse(request()->start), Carbon::parse(request()->end)])
                    ->orderBy('date', 'asc');
            }])
            ->when($searchValue, function ($query, $searchValue) {
                $query->where('employeeID', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('fullName', 'LIKE', '%' . $searchValue . '%');
            })
            ->orderBy('fullName', 'asc')->get();

        $this->startDate = Carbon::parse(request()->start);
        $this->endDate = Carbon::parse(request()->end);
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->employees;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $headingsArr = [];

        array_push($headingsArr, 'Employee Name');

        $currentDay = $this->startDate->copy();

        while ($currentDay->lessThanOrEqualTo($this->endDate)) {
            array_push($headingsArr, $currentDay->toFormattedDateString());
            $currentDay->addDay();
        }

        return $headingsArr;
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($employee): array
    {
        $mapArr = [];

        array_push($mapArr, $employee->fullName);

        $currentDay = $this->startDate->copy();

        while ($currentDay->lessThanOrEqualTo($this->endDate)) {
            $search = $employee->getAttendance->search(function ($item, $key) use ($currentDay) {
                return $item->date === $currentDay->toDateString();
            });

            if ($search !== false) {
                $status = '';

                if ($employee->getAttendance[$search]->status === 'absent') {
                    $status = 'A - ' . $employee->getAttendance[$search]->leaveType;
                } else {
                    $status = 'P';
                }

                array_push($mapArr, $status);
            } else {
                array_push($mapArr, '-');
            }

            $currentDay->addDay();
        }

        return $mapArr;
    }
}
