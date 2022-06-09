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

/////Routes for rating stors
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
//Route::post('store/create' , [App\Http\Controllers\StoreController::class , 'store']) ;
Route::post('store/update' , [App\Http\Controllers\StoreController::class , 'update']) ;
Route::post(  'store/register', [App\Http\Controllers\StoreManagerController::class, 'register']);
Route::post(  'store/login', [App\Http\Controllers\StoreManagerController::class, 'login']);
Route::get(  'store/index', [App\Http\Controllers\StoreManagerController::class, 'index']);
//Route::post('/registerStoreManager' , [App\Http\Controllers\StoreManagerController::class , 'register']) ;
Route::get(  'store/verify_email', [App\Http\Controllers\StoreManagerController::class, 'verify_email']);
Route::get(  'store/forget_password', [App\Http\Controllers\StoreManagerController::class, 'forget_password']);
Route::get('store/reset_password/{id}/{new_password}', [App\Http\Controllers\StoreManagerController::class, 'reset_password']);
Route::post('Privilladge/create' , [App\Http\Controllers\PrivilladgeController::class , 'store']) ;

/////////////////////////////////////////////////////////////////////////////////////////////////////
///
///batool
///
//Route::post(  '/Customer/html_email/{name}/{code}/{email}/{title}', [App\Http\Controllers\CustomerController::class, 'html_email']);
Route::post('/Customer/register' , [App\Http\Controllers\CustomerController::class , 'register']) ;
//Route::get('/Product/Product_All' , [App\Http\Controllers\ProductController::class , 'Product_All']);
Route::get('/Product_All' , [App\Http\Controllers\ProductController::class , 'Product_All']);
Route::get('/Product_Allf' , [App\Http\Controllers\ProductController::class , 'Product_Allf']);
Route::post('/P2' , [App\Http\Controllers\ProductController::class , 'store']);

Route::post('/Customer/changepassword' , [App\Http\Controllers\CustomerController::class , 'changepassword']) ;
Route::post('/Customer/login' , [App\Http\Controllers\CustomerController::class , 'login']) ;
Route::post('/Customer/logout' , [App\Http\Controllers\CustomerController::class , 'logout']) ;
Route::get('/Product/Product_Order_sales' , [App\Http\Controllers\ProductController::class , 'Product_Order_sales']);
Route::get('/Product/Product_Order_discount' , [App\Http\Controllers\ProductController::class , 'Product_Order_discount']);
Route::get('/Product/Product_Order_favorite' , [App\Http\Controllers\ProductController::class , 'Product_Order_favorite']);
Route::get('/Product/Product_Order_Salary' , [App\Http\Controllers\ProductController::class , 'Product_Order_Salary']);
Route::post('/FavoriteStore/Add_Favorite/{id}' , [App\Http\Controllers\FavoriteStoreController::class , 'Add_Favorite']);
Route::post('/FavoriteProduct/Add_Favorite/{id}' , [App\Http\Controllers\FavoriteProductController::class , 'Add_Favorite']);
Route::get('/Product/Show_Secondray' , [App\Http\Controllers\SecondrayClassificationController::class , 'Show_Secondray']);
Route::get('/Product/ShowClassification2/{id}' , [App\Http\Controllers\SecondrayClassificationController::class , 'ShowClassification2']);
Route::get('/FavoriteStore/Show_Favorite' , [App\Http\Controllers\FavoriteStoreController::class , 'Show_Favorite']);

Route::get('/Show_p' , [App\Http\Controllers\SecondrayClassificationController::class , 'Show_p']);

Route::group(['middleware' => ['auth:sanctum']],
    function () {


        Route::get('/Product/Show_Detalis/{id}' , [App\Http\Controllers\ProductController::class , 'Show_Detalis']);

        Route::post('/SecondrayClassification/ShowClassification/{id}/{title}' , [App\Http\Controllers\SecondrayClassificationController::class , 'shwoo']);
        Route::delete('/FavoriteProduct/Delete_Favorite/{id}' , [App\Http\Controllers\FavoriteProductController::class , 'Delete_Favorite']);
        Route::delete('/FavoriteStore/Delete_Favorite/{id}' , [App\Http\Controllers\FavoriteStoreController::class , 'Delete_Favorite']);


        ;});
Route::get('/FavoriteProduct/Show_Favorite' , [App\Http\Controllers\FavoriteProductController::class , 'Show_Favorite']);
