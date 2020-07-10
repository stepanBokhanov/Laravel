<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CoreRequest extends FormRequest
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Validator $validator
     * @return array
     */

    protected function failedValidation(Validator $validator)
    {
       throw new ValidationException($validator);
    }

    /*public function forbiddenResponse()
    {
        return new Response('You are not authorised', 403);
    }*/
}