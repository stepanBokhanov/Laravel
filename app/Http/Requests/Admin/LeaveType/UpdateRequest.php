<?php
namespace App\Http\Requests\Admin\LeaveType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Admin\Employee
 */
class UpdateRequest extends FormRequest
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
        $rules['leaveType']   = [
            'required',
            Rule::unique('leavetypes')->ignore($this->route('leavetype'), 'id'),
        ];
        $rules['num_of_leave']   = 'required|numeric';
        return $rules;
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
