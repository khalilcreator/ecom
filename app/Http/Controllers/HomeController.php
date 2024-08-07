<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){
        $product=Product::paginate(6);
        return view('home.userpage',compact('product'));
    }
    public function redirect(){
        $usertype = Auth::user()->usertype;
        if($usertype=='1'){
            $total_product=product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            // for total revenue
            $order=Order::all();
            $total_revenu=0;
            foreach($order as $order){
                $total_revenu=$total_revenu+$order->price;
            }
            $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();
            $total_processing=Order::where('delivery_status','=','processing')->get()->count();

          return   view('admin.home',compact('total_product','total_order','total_user','total_revenu','total_delivered','total_processing'));
        }else{
            $product=Product::paginate(6);
            return view('home.userpage',compact('product'));
        }
    }
    public function product_details($id){
        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id){
        // check if user is logged in
      if(Auth::id()){
        // fetch data of login user
        $user=Auth::user();
        $user_id=$user->id;
        // fetch data of product
        $product=Product::find($id);
        $product_exist_id=Cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();
        if($product_exist_id!=null)
        {
         // if product exist in cart
         $cart=Cart::find($product_exist_id)->first();
          $quantity=$cart->quantity;
          $cart->quantity=$quantity + $request->quantity;
          if($product->disscount_price){
            $cart->price=$product->disscount_price * $cart->quantity;
        }else{
        $cart->price=$product->price  * $cart->quantity;
        }
          $cart->save();
        }else{
        // add into cart table
        $cart= new cart;
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->phone=$user->phone;
        $cart->address=$user->address;
        $cart->user_id=$user->id;
        $cart->user_id=$user->id;
        $cart->product_title=$product->title;
        //check if product has disscounted price
        if($product->disscount_price){
            $cart->price=$product->disscount_price * $request->quantity;
        }else{
        $cart->price=$product->price  * $request->quantity;
        }
        $cart->image=$product->image;
        $cart->product_id=$product->id;
        $cart->quantity=$request->quantity;
        $cart->save();
       }
        return redirect('show_cart');
      }else{
        // if not logged in send to login page
        return redirect('login');
      }
    }
    public function show_cart(){
        if(Auth::id()){
        $id=Auth::user()->id;
        $cart=Cart::where('user_id','=',$id)->get();
        return view('home.showcart',compact('cart'));
        }else{
            return redirect('login');
        }
    }
    public function remove_cart($id){
     $cart =cart::find($id);
     $cart->delete();
     return redirect()->back();
    }
    public function cash_order(){
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data){
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->name=$data->name;
            $order->payment_status="cah on delivery";
            $order->delivery_status="processing";
            $order->save();
            // now delete from cart table
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We have recived Your Order.We will connect you soon.');
    }
    public function stripe($totalprice){
        return view('home.stripe',compact('totalprice'));
    }
    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for paying."
        ]);
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data){
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->name=$data->name;
            $order->payment_status="Paid";
            $order->delivery_status="processing";
            $order->save();
            // now delete from cart table
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
        Session::flash('success', 'Payment successful!');

        return back();
    }
    public function show_order(){
        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;
            $order=Order::where('user_id','=',"$userid")->get();
         return view('home.order',compact('order'));
        }else{
            return redirect('login');
        }
    }
    public function order_cancel($id){
        $order=Order::find($id);
        $order->delivery_status="Order Cancled";
        $order->save();
        return redirect()->back();
    }
    public function search_product(request $Request){
        $search=$Request->search;
        $product=Product::where('title','Like',"%$search%")->orwhere('category','Like',"%$search%")->orwhere('description','Like',"%$search%")->paginate(6);
        return view('home.userpage',compact('product','search'));
    }
    public function product(){
        $product=Product::paginate(10);
        return view('home.all_product',compact('product'));

    }
    public function search_allproducts(request $Request){
        $search=$Request->search;
        $product=Product::where('title','Like',"%$search%")->orwhere('category','Like',"%$search%")->orwhere('description','Like',"%$search%")->paginate(10);
        return view('home.all_product',compact('product','search'));
    }
    public function contactus(){
        return view('home.contact');
    }
    public function contact_submit(request $request){
      if(Auth::id()){
        $contact = new contact;
        $contact->name= $request->name;
        $contact->email= $request->email;
        $contact->phone= $request->phone;
        $contact->issue= $request->issue;
        $contact->save();
        return redirect()->back()->with('message','Product Added Succesfully!');
      }else{
        return redirect('login');
      }
    }
}
