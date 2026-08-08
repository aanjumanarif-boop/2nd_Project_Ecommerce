<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Products;
use App\Models\Size;
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

            //Add Colors...
        if(isset($request->color_name) && $request->color_name[0] != null){
            foreach($request->color_name as $singleColor){
                $color = new Color();

                $color->product_id = $products->id;
                $color->color_name = $singleColor;

                $color->save();
            }
        }
        
         //Add Sizes...
        if(isset($request->size_name) && $request->size_name[0] != null){
            foreach($request->size_name as $singleSize){
                $size = new Size();

                $size->product_id = $products->id;
                $size->size_name = $singleSize;

                $size->save();
            }
        }

               //Gallery Images...
        if(isset($request->gallery_image)){
            foreach($request->gallery_image as $singleImage){
                $galleryImage = new GalleryImage();
                
                $galleryImage->product_id = $products->id;

                $imageName = rand().'.'.$singleImage->getClientOriginalExtension(); //4347657.jpg
                $singleImage->move('admin/galleryImage', $imageName);

                $galleryImage->image = url('admin/galleryImage/'.$imageName); //http://127.0.0.1:8000/admin/category/4347657.jpg

                $galleryImage->save();
            }
        }

       toastr()->success('products Create Successfully.');
       return redirect()->back();

    } 
    
     public function list ()
    {
        $products =Products::orderBy('id','desc')->paginate(3);
        return view('admin.product.list', compact('products'));
    }

     public function changeStatus ($id)
     {
        $products = Products::find($id);

        if($products->status == 'active'){
            $products->status = 'inactive';
        }
        else{
            $products->status = 'active';
        }

        $products->save();
        return redirect()->back();
    }

      public function edit ($id)
    {
        $product = Products::where('id', $id)->with('color', 'size', 'galleryImage')->first();
        $categories = Category::orderBy('name', 'asc')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->get();
        return view('admin.product.edit', compact('categories', 'subCategories', 'product'));
    }

     public function update (Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku_code' => 'nullable|unique:products,sku_code,'.$id,
            'cat_id' => 'required|integer',
            'subcat_id'=> 'required|integer',
            'buying_price' => 'required',
            'regular_price' => 'required',
            'qty' => 'required|integer',
            'product_type' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|max:2048',
            'gallery_image' => 'max:2048'
        ],[
            'name.required' => 'প্রোডাক্ট এর নাম জরুরি',
            'name.max' => 'প্রোডাক্ট এর নাম সর্বোচ্চ 255 ক্যারেক্টর!',
            'buying_price.required' => 'পণ্যের ক্রয় মূল্য জরুরি '
        ]);

        $product = Products::find($id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->sku_code = $request->sku_code;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->buying_price = $request->buying_price;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->qty = $request->qty;
        $product->product_type = $request->product_type;
        $product->description = $request->description;
        $product->product_policy = $request->product_policy;

        if(isset($request->image)){
            if($product->image && file_exists('admin/product/'.basename($product->image))){
                unlink('admin/product/'.basename($product->image));
            }
            $image = $request->file('image');
            $imageName = rand().'.'.$image->getClientOriginalExtension(); //4347657.jpg
            $image->move('admin/product', $imageName);

            $product->image = url('admin/product/'.$imageName); //http://127.0.0.1:8000/admin/category/4347657.jpg
        }

        $product->save();

        //Add Colors...
        if(isset($request->color_name) && $request->color_name[0] != null){
            Color::where('product_id', $id)->delete();
            foreach($request->color_name as $singleColor){
                $color = new Color();

                $color->product_id = $product->id;
                $color->color_name = $singleColor;

                $color->save();
            }
        }

        //Add Sizes...
        if(isset($request->size_name) && $request->size_name[0] != null){
            Size::where('product_id', $id)->delete();
            foreach($request->size_name as $singleSize){
                $size = new Size();

                $size->product_id = $product->id;
                $size->size_name = $singleSize;

                $size->save();
            }
        }

        //Gallery Images...
        if(isset($request->gallery_image)){
            $oldImages = GalleryImage::where('product_id', $id)->get();

            foreach($oldImages as $singleOldImage){
                if($singleOldImage->image && file_exists('admin/galleryImage/'.basename($singleOldImage->image))){
                    unlink('admin/galleryImage/'.basename($singleOldImage->image));
                }
            }

            GalleryImage::where('product_id', $id)->delete();

            foreach($request->gallery_image as $singleImage){
                $galleryImage = new GalleryImage();
                
                $galleryImage->product_id = $product->id;

                $imageName = rand().'.'.$singleImage->getClientOriginalExtension(); //4347657.jpg
                $singleImage->move('admin/galleryImage', $imageName);

                $galleryImage->image = url('admin/galleryImage/'.$imageName); //http://127.0.0.1:8000/admin/category/4347657.jpg

                $galleryImage->save();
            }
        }

        toastr()->success('Product created successfully');
        return redirect()->back();
    }
    
      public function delete ($id)
    {
        $product = Products::find($id);

        Color::where('product_id', $id)->delete();

        Size::where('product_id', $id)->delete();

        $oldImages = GalleryImage::where('product_id', $id)->get();

        foreach($oldImages as $singleOldImage){
            if($singleOldImage->image && file_exists('admin/galleryImage/'.basename($singleOldImage->image))){
                unlink('admin/galleryImage/'.basename($singleOldImage->image));
            }
        }

        GalleryImage::where('product_id', $id)->delete();

        if($product->image && file_exists('admin/product/'.basename($product->image))){
            unlink('admin/product/'.basename($product->image));
        }

        $product->delete();

        toastr()->success('Product Deleted Successfully');
        return redirect()->back();
    }
} 

