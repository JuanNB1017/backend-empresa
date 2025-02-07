<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Helpers extends Controller
{
    // this function check if the response about the database is empty
    public function checkResponsesByStatus($datas){
        $response = [];

        $cuenta = count($datas); 

        if (intval($cuenta) > 0) { 
            $response = [
                'code' => 200, 
                'data' => $datas,
                'message' => 'Petition successfully',
                'status' => true
            ];
        } else if (intval($cuenta) <= 0) {  
            $response = [
                'code' => 201, 
                'data' => $datas,
                'message' => 'Data is empty, check your petition',
                'status' => true
            ];
        }

        return $response;
    }

    // this function only returns the base structure of error in tryCatchs
    public function throwErrors ($th){
        return [
            'code'=>400,
            'data'=>$th,
            'message'=>'Fatal error, check your connection or information about your petition',
            'status'=>false
        ];
    }
}
