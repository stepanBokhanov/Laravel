<?php
namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Admin\Employee
 */
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        // If admin
        return admin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employeeID'    => 'required|unique:employees,employeeID|alpha_dash',
            'fullName'      => 'required',
            'email'         => 'required|email|unique:employees',
            'password'      => 'required',
            'profileImage'  => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:4000',
            'resume'        => 'max:1000',
            'offerLetter'   => 'max:1000',
            'joiningLetter' => 'max:1000',
            'contract'      => 'max:1000',
            'IDProof'       => 'max:1000',
        ];
    }

    public function messages()
    {
        return [
            'employeeID.required' => 'Employee ID is required'
        ];
    }
}
