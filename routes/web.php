<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::Class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// for admin and user login
Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
// for category
Route::get('/view_category',[AdminController::class,'view_category']);
Route::post('/add_category',[AdminController::Class,'add_category']);
Route::get('/delet_category/{id}',[AdminController::Class,'delet_category']);
// for products
Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('/show_product',[AdminController::class,'show_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
Route::get('/product_details/{id}',[HomeController::class,'product_details']);
// cart
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('show_cart',[HomeController::class,'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
// order
Route::get('cash_order',[HomeController::class,'cash_order']);
Route::get('stripe/{totalprice}',[HomeController::class,'stripe']);

// stripe payment method
Route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');


// order for admin panel
Route::get('/order',[AdminController::Class,'order']);
Route::get('/delivered/{id}',[AdminController::class,'delivered']);
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
// send mail
Route::get('/send_email/{id}',[AdminController::class,'send_email']);
Route::post('/search',[AdminController::Class,'searchdata']);
// orders for userpage
Route::get('/show_order',[HomeController::Class,'show_order']);
Route::get('order_cancel/{id}',[HomeController::Class,'order_cancel']);
// search products
Route::get('/search_product',[HomeController::Class,'search_product']);
Route::get('/product_all',[HomeController::Class,'product']);
Route::get('/search_allproducts',[HomeController::Class,'search_allproducts']);

// user contact
Route::get('/contactus',[HomeController::class,'contactus']);
Route::post('/contact_submit',[HomeController::class,'contact_submit']);

// admin contact
Route::get('admin_contact',[AdminController::class,'admin_contact']);
Route::get('resolve_contact/{id}',[AdminController::Class,'resolve_contact']);
Route::get('revoke_contact/{id}',[AdminController::Class,'revoke_contact']);

