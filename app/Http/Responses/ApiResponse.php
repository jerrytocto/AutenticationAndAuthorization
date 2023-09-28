<?php
namespace App\Http\Responses;

class ApiResponse{
    //Método para cuando la respuesta es exitosa
    public static function success($message='',$status=200,$data=[])
    {
        return response()->json([
            'message'=>$message,
            'status'=>$status,
            'error'=>false,
            'data'=>$data
        ],$status);
    }

    //Método para cuando la respuesta es errada
    public static function error($message='',$status=500,$data=[])
    {
        return response()->json([
            'message'=>$message,
            'status'=>$status,
            'error'=>true,
            'data'=>$data
        ],$status);
    }
}


