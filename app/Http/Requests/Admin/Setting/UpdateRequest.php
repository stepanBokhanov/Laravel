<?php
namespace App\Http\Requests\Admin\Setting;

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
            'website'    =>  'required',
            'email'      =>  'required|email',
            'name'       =>  'required',
            'logo'       =>  'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:1000'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
