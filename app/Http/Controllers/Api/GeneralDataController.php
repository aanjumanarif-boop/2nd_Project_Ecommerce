<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralDataController extends Controller
{
    public function getGeneralData()
    {  
        try{
       $setting = Setting::first();
        if(!$setting){
              return response()->json([
                'error'=>'true',
                'message'=>'data not found',
               ' generalData' => [], 
           ],404);
          }
         return response()->json([
            'error' =>'true',
            'message' =>'General Retrived Successfully',
            'generalData' => $setting
         ],200);
          } catch(\Exception $e){
                  return response()->json([
                    'error' =>'true',
                    'message' =>'An Error occured while Retriving Data',
                    'generalData' => [],
                    'errorMessage' => $e->getmessage()
                  ],500);
         
         }
    }
}
