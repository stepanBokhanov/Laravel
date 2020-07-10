<?php

namespace App\Classes;

use Illuminate\Contracts\Validation\Validator;

/**
 * Class Reply
 * @package App\Classes
 */
class Reply
{

    /**
     * @param $messageOrData
     * @param null $data
     * @return array
     */
    public static function success($messageOrData, $data = null)
    {
        $response = [
            'status' => 'success'
        ];

        if (!empty($messageOrData) && !is_array($messageOrData)) {
            $response['message'] = Reply::getTranslated($messageOrData);
        }

        if (is_array($data)){
            $response = array_merge($data, $response);
        }

        if (is_array($messageOrData)) {
            $response = array_merge($messageOrData, $response);
        }

        return $response;
    }

    /**
     * @param $message
     * @param null $errorName
     * @param array $errorData
     * @return array
     */
    public static function error($message, $errorName = null, $errorData = [])
    {
        return [
            'status' => 'fail',
            'error_name' => $errorName,
            'data' => $errorData,
            'message' => Reply::getTranslated($message)
        ];
    }

    /** Return validation errors
     * @param \Illuminate\Validation\Validator|Validator $validator
     * @return array
     */

    public static function formErrors($validator)
    {
        return [
            'status' => 'fail',
            'errors' => $validator->getMessageBag()->toArray()
        ];
    }

    /** Response with redirect action. This is meant for ajax responses and is not meant for direct redirecting
     * to the page
     * @param $url string to redirect to
     * @param null $message Optional message
     * @return array
     */

    public static function redirect($url, $message = null)
    {
        if ($url == 'reload') {
            return [
                'status' => 'success',
                'action' => 'reload',
                'message' => Reply::getTranslated($message),
            ];
        }

        if ($message) {
            return [
                'status'  => 'success',
                'message' => Reply::getTranslated($message),
                'action'  => 'redirect',
                'url'     => $url
            ];
        }
        else {
            return [
                'status' => 'success',
                'action' => 'redirect',
                'url' => $url
            ];
        }
    }

    /**
     * @param $message
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    private static function getTranslated($message)
    {
        $trans = trans($message);

        if ($trans == $message) {
            return $message;
        }
        else {
            return $trans;
        }
    }

    public static function dataOnly($data)
    {
        return $data;
    }

    
    public static function successWithData($message, $data)
    {
        $response = Reply::success($message);

        return array_merge($response, $data);
    }

    public static function successWithDataNew($data)
    {
        $response = [
            'status' => 'success'
        ];

        $response['data'] = $data;

        return $response;
    }
}