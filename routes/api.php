<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatuseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingOrderController;
use App\Http\Controllers\RatingStoreController;
use App\Http\Controllers\StoreController;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

////Route Of Stores
Route::resource('stores' , StoreController :: class) ;
Route::get('stores/order/reviews' , [StoreController::class , 'order_by_review']) ;
Route::get('stores/order/sales' , [StoreController::class , 'order_by_sales']) ;

////Routes for Prodcuts
Route::resource('products' , ProductController :: class) ;


/////Routes for rating stores
Route::resource('rating_store' , RatingStoreController::class);


/////Routes for rating products
Route::resource('rating_product' , RatingOrderController::class);


/////Routes for Orders
Route::resource('orders' , OrderController::class);


////Routes for order
Route::resource('order_status', OrderStatuseController::class);
//Route::resource('accept_orders' , [OrderController::class , 'acceptence_orders']);

////////////////////////bayan //////////////////////////////////

//    "name":"bayan",
//    "image":"jjjjjjjjjjjjjjjj",
//    "discription":"jjjjjjj",
//    "facebook":"iuhbbj",
//       "delivery_area":"dfdsfds",
//    "mobile":"8687676767"
Route::post('store/create' , [App\Http\Controllers\StoreController::class , 'store']) ;
//"store":"2",
Route::post('store/update' , [App\Http\Controllers\StoreController::class , 'update']) ;

//"name" :"بيان",
//    "password" :"75f65hffghf",
//    "email":"ite2bayan@gmail.com",
//    "store_id":"2"
Route::post(  'store/register', [App\Http\Controllers\StoreManagerController::class, 'register']);

//    "password" :"75f65hffghf",
//    "email":"ite2bayan@gmail.com",
Route::post(  'store/login', [App\Http\Controllers\StoreManagerController::class, 'login']);
//    "id":"3"
Route::get(  'store/index', [App\Http\Controllers\StoreManagerController::class, 'index']);




//    "persone":"ite2bayan@gmail.com"
//     "code":"hhh"
Route::get(  'store/verify_email', [App\Http\Controllers\StoreManagerController::class, 'verify_email']);
Route::get(  'store/forget_password', [App\Http\Controllers\StoreManagerController::class, 'forget_password']);
Route::get('store/reset_password/{id}/{new_password}', [App\Http\Controllers\StoreManagerController::class, 'reset_password']);




//PrivilladgeController
Route::post('Privilladge/create' , [App\Http\Controllers\PrivilladgeController::class , 'store']) ;

//Route::post('collection/create' , [App\Http\Controllers\CollectionController::class , 'store']) ;
Route::post('collection/register' , [App\Http\Controllers\CustomerController::class , 'register']) ;

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post('collection/create' , [App\Http\Controllers\CollectionController::class , 'store']) ;
});
