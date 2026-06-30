<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Products;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function create ()
    {
       $categories = Category::orderBy('name','asc')->get();
       $subcategories = SubCategory::orderBy('name', 'asc')->get();
       return view('admin.product.create',compact('categories','subcategories'));
    }

    public function store (Request $request)
    {   
          $request->validate([
            'name' => 'required|string|max:255',
            'sku_code' => 'nullable|unique:products,sku_code',
            'cat_id' => 'required|integer',
            'subcat_id'=> 'required|integer',
            'buying_price' => 'required',
            'regular_price' => 'required',
            'qty' => 'required|integer',
            'product_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'gallery_image' => 'required|max:2048'
        ],[
            'name.required' => 'প্রোডাক্ট এর নাম জরুরি',
            'name.max' => 'প্রোডাক্ট এর নাম সর্বোচ্চ 255 ক্যারেক্টর!',
            'buying_price.required' => 'পণ্যের ক্রয় মূল্য জরুরি '
        ]);


        $products = new Products();
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->sku_code = $request->sku_code;
        $products->cat_id = $request->cat_id;
        $products->subcat_id = $request->subcat_id;
        $products->buying_price = $request->buying_price;
        $products->regular_price = $request->regular_price;
        $products->discount_price = $request->discount_price;
        $products->qty = $request->qty;
        $products->product_type = $request->product_type;
        $products->description = $request->description;
        $products->product_policy = $request->product_policy;
      
        if(isset($request->image)){
        $image =$request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalExtension();//8554544.jpg
        $image->move('admin/product',$imageName);

        $products->image = url('admin/product/'.$imageName);//http://127.0.0.1:8000/admin/category/8554544.jpg
     }
      

        $products->save();

       toastr()->success('products Create Successfully.');
       return redirect()->back();

    }  
}
