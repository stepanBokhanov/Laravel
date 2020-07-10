<?php

namespace App\Http\Requests\Admin\Holiday;

use Illuminate\Foundation\Http\FormRequest;

class PreassignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preassigned' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'preassigned.required' => 'Date is not selected.'
        ];
    }
}
