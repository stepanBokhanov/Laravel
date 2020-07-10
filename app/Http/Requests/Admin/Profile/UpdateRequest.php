<?php
namespace App\Http\Requests\Admin\Profile;

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
        $rules = [];

        if($this->type == 'name')
        {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
        }
        else{
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required|min:5';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
