<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = [], $message = 'Success', $status = 200)
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    public static function error($message = 'Error', $status = 400)
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
