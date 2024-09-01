<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function apiResponse($code=200,$message=null,$error=null,$data=null)
    {
        $array = [
            'code' => $code,
            'message' => $message,
            'error' => $error,
            'data' => $data,
        ];

        return response($array,200);
    }
}
