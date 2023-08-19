<?php

namespace App\Services;


class GeneralService
{
    public function returnResponse($response)
    {
        $data= !empty($response["data"]) ? $response["data"] : [];
        $code= !empty($response["code"]) ? $response["code"] : "";
        $msg= !empty($response["msg"]) ? $response["msg"] : "";
        return  response()->json(["code"=>$code,"data"=>$data,"msg"=>$msg]);
    }
}
