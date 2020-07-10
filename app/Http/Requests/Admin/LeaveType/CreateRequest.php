<?php
namespace App\Http\Requests\Admin\LeaveType;

use App\Http\Requests\CoreRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Admin\Employee
 */
class CreateRequest extends CoreRequest
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
            'leaveType' => 'required|unique:leavetypes,leaveType',
            'num_of_leave' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
