<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function getProducts ()
    {
        try {
            $products = Products::where('status', 'active')->orderBy('id', 'desc')->paginate(20);

            if($products->isEmpty()){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'products' => []
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Products Retrived Successfully',
                'products' => $products
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'products' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

   public function getProductDetails ($slug)
    {
        try{
            $product = Products::with('color', 'size', 'galleryImage', 'review')->where('slug', $slug)->first();

            if(!$product){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'product' => []
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Product Retrived Successfully',
                'product' => $product
            ], 200);


        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'product' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }
  

      public function getTypewiseProducts ()
    {
        try{
            $hotProducts = Products::where('product_type', 'hot')->where('status', 'active')->orderBy('id', 'desc')->get();
            $newProducts = Products::where('product_type', 'new')->where('status', 'active')->orderBy('id', 'desc')->get();
            $regularProducts = Products::where('product_type', 'regular')->where('status', 'active')->orderBy('id', 'desc')->get();
            $discountProducts = Products::where('product_type', 'discount')->where('status', 'active')->orderBy('id', 'desc')->get();

            if($hotProducts->isEmpty() && $newProducts->isEmpty() && $regularProducts->isEmpty() && $discountProducts->isEmpty()){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'products' => []
                ], 404);
            }

            $products = [
                'hotProducts' => $hotProducts,
                'newProducts' => $newProducts,
                'regularProducts' => $regularProducts,
                'discountProducts' => $discountProducts,
            ];

            return response()->json([
                'error' => false,
                'message' => 'Products Retrived Successfully',
                'products' => $products
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'products' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

      public function getCategoryewiseProducts ($id)
    {
        try{
            $products = Products::where('cat_id', $id)->where('status', 'active')->orderBy('id', 'desc')->get();

            if($products->isEmpty()){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'products' => []
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Products Retrived Successfully',
                'products' => $products
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'products' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    
      public function getSubCategoryewiseProducts ($id)
    {
        try{
            $products = Products::where('subcat_id', $id)->where('status', 'active')->orderBy('id', 'desc')->get();

            if($products->isEmpty()){
                return response()->json([
                    'error' => true,
                    'message' => 'No Data found',
                    'products' => []
                ], 404);
            }

            return response()->json([
                'error' => false,
                'message' => 'Products Retrived Successfully',
                'products' => $products
            ], 200);

        } catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'An Error Occured While Retriving Data',
                'products' => [],
                // 'errorMessage' => $e->getMessage()
            ], 500);
        }
    }
}
