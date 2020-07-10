<?php
namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $searchValue = null) {
        $this->searchValue = $searchValue;
    }

    public function query()
    {
        return Employee::query()->join('designation', 'employees.designation', '=', 'designation.id')
            ->join('department', 'department.id', '=', 'designation.deptID')
            ->leftJoin('bank_details', 'bank_details.employeeID', '=', 'employees.employeeID')
            ->select(
                'employees.id','employees.employeeID','employees.fullName',
                'department.deptName as department',
                'designation.designation as designation',
                'employees.fatherName','employees.mobileNumber','employees.date_of_birth','employees.joiningDate','employees.localAddress','employees.permanentAddress','employees.status',
                'employees.exit_date',
                'bank_details.accountName','bank_details.accountNumber','bank_details.bank','bank_details.pan','bank_details.branch',
                'bank_details.ifsc'
            )
            ->when($this->searchValue, function($query, $searchValue) {
                $query->where('employees.employeeID', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('employees.email', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('employees.fullName', 'LIKE', '%'.$searchValue.'%')
                        ->orWhere('designation.designation', 'LIKE', '%'.strtolower($searchValue).'%');
            })->orderBy('id','asc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'Full Name',
            'Department',
            'Designation',
            'Father Name',
            'Mobile Number',
            'Date Of Birth',
            'Joining Date',
            'Local Address',
            'Parmanent Address',
            'Status',
            'Exit Date',
            'Account Name',
            'Account Number',
            'Bank Name',
            'PAN Number',
            'Bank Branch',
            'Bank IFSC'
        ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->employeeID ?? '-',
            $employee->fullName,
            $employee->department ?? '-',
            $employee->designation ?? '-',
            $employee->fatherName ?? '-',
            $employee->mobileNumber ?? '-',
            $employee->date_of_birth ?? '-',
            $employee->joiningDate ?? '-',
            $employee->localAddress ?? '-',
            $employee->permanentAddress ?? '-',
            $employee->status,
            $employee->exit_date ?? '-',
            $employee->accountName ?? '-',
            $employee->accountNumber ?? '-',
            $employee->bank ?? '-',
            $employee->pan ?? '-',
            $employee->branch ?? '-',
            $employee->ifsc ?? '-',
        ];
    }
}
