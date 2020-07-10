<?php

namespace Modules\Core\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\BaseRequest;

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date.0' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.0' => '<strong>Error!</strong> Please select the date',
        ];
    }

}
