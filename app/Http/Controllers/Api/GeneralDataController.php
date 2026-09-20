<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SubCategory;
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
                'message'=>'No Data Found',
               ' generalData' => [], 
           ],404);
          }
         return response()->json([
            'error' =>'false',
            'message' =>'General Data Retrived Successfully',
            'generalData' => $setting
         ],200);
          } catch(\Exception $e){
                  return response()->json([
                    'error' =>'true',
                    'message' =>'An Error Occured while Retriving Data',
                    'generalData' => [],
                    'errorMessage' => $e->getmessage()
                  ],500);
         
         }
    }


      public function getCategories ()
    {
        try{
            $categories = Category::with('subCategory')->orderBy('name', 'asc')->get();

            if($categories->isEmpty()){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'categories' => []
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Categories Retrived Successfully',
                'categories' => $categories
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'categories' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

  
  public function getSubCategories ()
  {
    try{
       $subcategories = SubCategory::orderBy('name','asc')->get();
         if($subcategories->isEmpty()){
            return response()->json([
                'error' =>true,
                'message' => 'No Data Found',
                'subCategories' => []
            ],404);
         }

         return response()->json([
            'error'=> false,
            'message'=>'subCategory Retrived Successfully',
            'subcategories'=> $subcategories
         ],200);

    } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'categories' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
  }
}
}