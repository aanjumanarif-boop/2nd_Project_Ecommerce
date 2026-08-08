<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\contactMessage;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Products;
use App\Models\websitePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index ()
    {
        $hotProducts = Products::where('status', 'active')->where('product_type', 'hot')->paginate(30);
        $newProducts = Products::where('status', 'active')->where('product_type', 'new')->paginate(30);
        $regularProducts = Products::where('status', 'active')->where('product_type', 'regular')->paginate(30);
        $discountProducts = Products::where('status', 'active')->where('product_type', 'discount')->paginate(30);
        $homeCategories = Category::get();
        return view('frontend.index', compact('hotProducts','newProducts','regularProducts','discountProducts','homeCategories'));
    }

    public function productDetails($slug)
 {
        $product = Products::with('color','size','galleryImage','review')->where('slug',$slug)->first();
        $products = Products::where('id', '!=', $product->id)->where('cat_id', $product->cat_id)->orderBy('id', 'desc')->get();
        $detailsPageCategory = Category::get(); 

     return view('frontend.product-details', compact('product','products', 'detailsPageCategory'));
  }

     public function addtocartDetailsPage (Request $request, $id)
    {
        
        $product = Products::find($id);

        $cartProduct = Cart::where('product_id', $product->id)->where('ip_address', $request->ip())->first();

        if($cartProduct == null){
            $cart = new Cart();

            $cart->product_id = $product->id;
            $cart->color = $request->color;
            $cart->size = $request->size;
            $cart->qty = $request->qty;

            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            else{
                $cart->price = $product->regular_price;
            }

            $cart->ip_address = $request->ip();
            
            if(Auth::check()){
                $cart->user_id = Auth::user()->id;
            }

            $cart->save();
        }
        elseif($cartProduct != null){
            $cartProduct->color = $request->color;
            $cartProduct->size = $request->size;
            $cartProduct->qty = $request->qty;

            if($product->discount_price != null){
                $cartProduct->price = $product->discount_price;
            }
            else{
                $cartProduct->price = $product->regular_price;
            }            

            $cartProduct->save();
        }

        toastr()->success('Product added to cart successfully');

        if($request->action == 'buyNow'){
            return redirect('/checkout');
        }
        else{
            return redirect()->back();
        }


    }

     public function addtocart (Request $request, $id)
    {
        $product = Products::find($id);

        $cartProduct = Cart::where('product_id', $product->id)->where('ip_address', $request->ip())->first();

        if($cartProduct == null){
            $cart = new Cart();

            $cart->product_id = $product->id;
            $cart->qty = 1;

            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            else{
                $cart->price = $product->regular_price;
            }

            $cart->ip_address = $request->ip();
            
            if(Auth::check()){
                $cart->user_id = Auth::user()->id;
            }

            $cart->save();
        }

        elseif($cartProduct != null){
            $cartProduct->qty = 1;

            if($product->discount_price != null){
                $cartProduct->price = $product->discount_price;
            }
            else{
                $cartProduct->price = $product->regular_price;
            }            

            $cartProduct->save();
        }

        toastr()->success('Product added to cart successfully');
        return redirect()->back();
    }

    public function deleCart ($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        
        return redirect()->back();
    }
      
    public function shopProducts ()
    {
        return view('frontend.shop');
    }

    public function privacyPolicy ()
    {
        $privacyPolicy = websitePolicy::select('privacy_policy')->first();
        return view('frontend.privacy-policy', compact('privacyPolicy'));
    }

    public function termsConditions ()
    {
        $termsConditions = websitePolicy::select('terms_conditions')->first();
        return view('frontend.terms-conditions', compact('termsConditions')); 
    }

    public function refundPolicy ()
    {
        $refundPolicy = websitePolicy::select('refund_policy')->first();
        return view('frontend.refund-policy', compact('refundPolicy'));
    }

    public function paymentPolicy ()
    {
        $paymentPolicy = websitePolicy::select('payment_policy')->first();
        return view('frontend.payment-policy', compact('paymentPolicy'));
    }

    public function aboutUs ()
    {
        $aboutUs = websitePolicy::select('about_us')->first();
        return view('frontend.aboutus', compact('aboutUs')); 
    }

    public function contactUs ()
    {
        return view('frontend.contactus');
    }

    
    public function contactMessageStore (Request $request)
    {
        $contactMessage = new contactMessage();

        $contactMessage->name = $request->name;
        $contactMessage->phone = $request->phone;
        $contactMessage->email = $request->email;
        $contactMessage->subject = $request->subject;
        $contactMessage->message = $request->message;

        $contactMessage->save();
        
        toastr()->success('Message is sent successfully');
        return redirect()->back();
    }


    public function viewCart ()
    {
        return view('frontend.view-cart');
    }

    public function checkOut ()
    {
        return view('frontend.checkout');
    }

     public function orderStore (Request $request)
    {
        $order = new Order();

        $order->ip_address = $request->ip();
        $order->user_id = auth()->check() ? auth()->user()->id : null;

        $previousOrder = Order::orderBy('id', 'desc')->first();

        if($previousOrder == null){
            $generatedInvoice = 'XYZ-1';
            $order->invoice_number = $generatedInvoice;
        }
        elseif($previousOrder != null){
            $generatedInvoice = 'XYZ-'.$previousOrder->id+1;
            $order->invoice_number = $generatedInvoice;
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->charge = $request->charge;
        $order->price = $request->grandTotalPriceInput;

        $cartProducts = Cart::where('ip_address', $request->ip())->get();

        if($cartProducts->isNotEmpty()){
            $order->save();

            foreach($cartProducts as $cart){
                $orderDetails = new OrderDetails();

                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cart->product_id;
                $orderDetails->color = $cart->color;
                $orderDetails->qty = $cart->qty;
                $orderDetails->price = $cart->price;

                $orderDetails->save();
                $cart->delete();
            }

            return redirect('/order-confirmation/'.$generatedInvoice);
        }
        else{
            toastr()->error('Your cart is empty');
            return redirect('/');
        }
    }

    public function orderConfirmation ($invoice_id)
    {
        return view('frontend.thankyou', compact('invoice_id'));
    }

    public function categoryProducts ()
    {
         return view('frontend.category-products');
    }

    public function subcategoryProducts ()
    {
        return view('frontend./subcategory-products');
    }

    public function typeProducts ()
    {
        return view('frontend./type-products');
    }
}
