<?php
namespace App\Http\Requests\Admin\Department;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'deptName'   =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'deptName.required' => 'The department name field is required.',
        ];
    }
}
