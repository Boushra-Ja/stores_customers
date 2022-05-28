<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatuseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\RatingStoreController;
use App\Http\Controllers\StoreController;
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

//////////////////Boushra//////////////////////////////
////Route Of Stores
Route::resource('stores' , StoreController :: class) ;
Route::get('stores/order/reviews' , [StoreController::class , 'order_by_review']) ;
Route::get('stores/order/sales' , [StoreController::class , 'order_by_sales']) ;


////Routes for products
Route::resource('products' , ProductController::class);
Route::get('similar_products/{id}' , [ProductController::class , 'similar_products']);


/////Routes for rating products
Route::resource('rating_product' , ProductRatingController::class)->except('show' , 'edit' , 'destroy' ,'update');

/////Routes for rating products
Route::resource('rating_store' , RatingStoreController::class)->except('show' , 'edit' , 'destroy' ,'update');



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
//
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

Route::post('PrivilladgeStoreManager/create' , [App\Http\Controllers\PrivilladgeStoreManagerController::class , 'store']) ;


Route::post('classification_products/create' , [App\Http\Controllers\SecondrayClassificationProductController::class , 'store']) ;


Route::group(["middleware" => ["auth:sanctum"]], function(){

    //////collection
    Route::post('collection/create' , [App\Http\Controllers\CollectionController::class , 'store']) ;
    Route::get('collection/index' , [App\Http\Controllers\CollectionController::class , 'index']);
    Route::put('collection/update' , [App\Http\Controllers\CollectionController::class , 'update']) ;
    Route::put('collection/delete' , [App\Http\Controllers\CollectionController::class , 'delete']) ;


});

//
//"name":"mobil",
//"prepration_time":"2022-05-26 06:07:20",
//"party":"herhfj0",
//"discription":"rehuifhreuhfuihru",
//"image":"hguihhrghrghr",
//"age":"234",
//"selling_price":"2544",
//"cost_price":"789",
//"number_of_sales":"54",
//"return_or_replace":"0",
//"collection_id":"2",
//"discount_products_id":"1",
//"classification":[
//    1,2
//],
//"type":[
//
//{
//    "kk":"color",
//"value":[
//    "red","blue"
//]},
//
//
//{"kk":"size",
//"value":[
//    2,3
//]}
//
//]

Route::post('product/create' , [App\Http\Controllers\ProductController::class , 'store']) ;
Route::get('product/index' , [App\Http\Controllers\ProductController::class , 'index']);
Route::get('product/show' , [App\Http\Controllers\ProductController::class , 'show']);
Route::put('product/update' , [App\Http\Controllers\ProductController::class , 'update']) ;
Route::put('product/delete' , [App\Http\Controllers\ProductController::class , 'delete']) ;

//
//"title":"ffffffff",
//    "id":[
//    "fwefwfw",
//    "sggsgsg",
//    "srgrgreg"
//]
Route::post('classification/create' , [App\Http\Controllers\ClassificationController::class , 'store']) ;


Route::post('helper/create' , [App\Http\Controllers\HelperController::class , 'store']) ;
