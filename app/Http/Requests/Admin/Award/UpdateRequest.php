<?php
namespace App\Http\Requests\Admin\Award;

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
            'awardName'  => 'required',
            'employeeID' => 'required',
            'gift'       => 'required',
            'cashPrice'  => 'required',
            'forMonth'   => 'required',
            'forYear'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
