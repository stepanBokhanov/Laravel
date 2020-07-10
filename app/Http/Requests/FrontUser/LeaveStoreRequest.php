<?php

namespace App\Http\Requests\FrontUser;

use Illuminate\Foundation\Http\FormRequest;

class LeaveStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.*' => '<strong>Error!</strong> Please select the date',
        ];
    }

}
