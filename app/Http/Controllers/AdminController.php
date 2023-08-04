<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

use PDF;
class AdminController extends Controller
{
   public function view_category(){
    $data=Category::all();
    return view('admin.category',compact('data'));
   }
   public function add_category(request $request){
    $data = new Category;
    $data->category_name = $request->category_name;
    $data->save();
    return redirect()->back()->with('message','Category is added Successfully');
   }
   public function delet_category($id){
    $data=Category::find($id);
    $data->delete();
    return redirect()->back()->with('message','Category is Deleted');
   }
   public function view_product(){
    $category=Category::all();
    return view('admin.product',compact('category'));
   }
   public function add_product(Request $request){
      $product = new Product;
      $product->title=$request->title;
      $product->description=$request->description;
      $product->price=$request->price;
      $product->quantity=$request->quantity;
      $product->disscount_price=$request->discount_price;
      $product->category=$request->category;
      $image=$request->image;
      $imagename=time().".".$image->getClientOriginalExtension();
      $request->image->move('product',$imagename);
      $product->image=$imagename;

      $product->save();
      return redirect()->back()->with('message','Product added successfully');
   }
   public function show_product(){
    $product=Product::all();
    return view('admin.show_prouct',compact('product'));
   }

   public function delete_product($id){

   $product=Product::find($id);
    $product->delete();
    return redirect()->back()->with('message','Product is Deleted');
   }
   public function update_product($id){
    $category=Category::all();
    $product=Product::find($id);
    return view('admin.update_product',compact('category'),compact('product'));
   }
   public function update_product_confirm(request $request,$id){
    $product=Product::find($id);
    $product->title=$request->title;
    $product->description=$request->description;
    $product->price=$request->price;
    $product->quantity=$request->quantity;
    $product->disscount_price=$request->discount_price;
    $product->category=$request->category;
    $image=$request->image;
    if($image){
        $imagename=time().".".$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
    }
    $product->save();
    return redirect()->back()->with('message','Product added successfully');
   }
   public function order(){
    $order=Order::all();
    return view('admin.order',compact('order'));
   }
   public function delivered($id){
    $order=Order::find($id);
    $order->delivery_status="delivered";
    $order->payment_status="paid";
    $order->save();
    return redirect()->back();
   }
   public function print_pdf($id){
    $order=order::find($id);
    $pdf=PDF::loadview('admin.pdf',compact('order'));
    return $pdf->download('order_detailis.pdf');
   }
   public function send_email($id){
     return view('admin.email_info');
   }
   public function searchdata(Request $request){
     $searchtxt=$request->search;
     $order=Order::where('name','LIKE',"%$searchtxt%")->orWhere('email','LIKE',"%$searchtxt%")->orWhere('phone','LIKE',"%$searchtxt%")->orWhere('product_title','LIKE',"%$searchtxt%")->get();
     return view('admin.order',compact('order'));
   }
   public function admin_contact(){

        $user=Auth::user();
        $usertype =$user->usertype;
        if($usertype==1){
         $contact=Contact::all();
        return view('admin.contact',compact('contact'));
        }
     else{
        return view('home.userpage');
   }
  }
  public function resolve_contact($id){
    if(Auth::id()){
       $user=auth::user();
       $usertype=$user->usertype;
       if($usertype==1){
            $contact=contact::find($id);
            $contact->status ='resolved';
            $contact->save();
            return redirect()->back()->with('message','Status Changed to resolved!');
       }else{
        return riew('home.userpage');
       }
    }else{
        return redirect('login');
    }
  }
  public function revoke_contact($id){
    if(Auth::id()){
        $user=auth::user();
        $usertype=$user->usertype;
        if($usertype==1){
             $contact=contact::find($id);
             $contact->status ='revoked';
             $contact->save();
             return redirect()->back()->with('message','Status Changed to revoked!');
        }else{
         return riew('home.userpage');
        }
     }else{
         return redirect('login');
     }
  }
}
