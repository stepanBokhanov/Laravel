<?php

namespace App\Classes;

use Illuminate\Contracts\Validation\Validator;
use Exception;
/**
 * Class Reply
 * @package App\Classes
 */
class Validation extends Exception
{

    /**
     * The validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    public $validator;

    public function __construct($validator, $response = null, $errorBag = 'default')
    {
        $this->validator = $validator;
    }

    public static function formErrors($validator)
    {
        return [
            'status' => 'fail',
            'errors' => $validator->getMessageBag()->toArray()
        ];
    }
}