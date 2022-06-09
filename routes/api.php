<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

////Route Of Stores
Route::resource('stores' , StoreController :: class) ;
Route::get('stores/order/reviews' , [StoreController::class , 'order_by_review']) ;
Route::get('stores/order/sales' , [StoreController::class , 'order_by_sales']) ;





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
Route::post('/Customer/changepassword' , [App\Http\Controllers\CustomerController::class , 'changepassword']) ;
Route::post('/Customer/login' , [App\Http\Controllers\CustomerController::class , 'login']) ;
Route::post('/Customer/logout' , [App\Http\Controllers\CustomerController::class , 'logout']) ;
Route::group(['middleware' => ['auth:sanctum']],
    function () {


        Route::get('/Product/Show_Detalis/{id}' , [App\Http\Controllers\ProductController::class , 'Show_Detalis']);
        Route::get('/Product/Product_Order_sales' , [App\Http\Controllers\ProductController::class , 'Product_Order_sales']);
        Route::get('/Product/Product_Order_discount' , [App\Http\Controllers\ProductController::class , 'Product_Order_discount']);
        Route::get('/Product/Product_Order_favorite' , [App\Http\Controllers\ProductController::class , 'Product_Order_favorite']);
        Route::get('/Product/Product_Order_Salary' , [App\Http\Controllers\ProductController::class , 'Product_Order_Salary']);

        Route::get('/Product/Product_All' , [App\Http\Controllers\ProductController::class , 'Product_All']);
        Route::get('/Product/Show_Classification' , [App\Http\Controllers\ClassificationController::class , 'Show_Classification']);
        Route::get('/Product/Show_Secondray' , [App\Http\Controllers\SecondrayClassificationController::class , 'Show_Secondray']);
        Route::post('/SecondrayClassification/ShowClassification/{id}/{title}' , [App\Http\Controllers\SecondrayClassificationController::class , 'shwoo']);
        Route::post('/FavoriteProduct/Add_Favorite/{id}' , [App\Http\Controllers\FavoriteProductController::class , 'Add_Favorite']);
        Route::get('/FavoriteProduct/Show_Favorite' , [App\Http\Controllers\FavoriteProductController::class , 'Show_Favorite']);
        Route::delete('/FavoriteProduct/Delete_Favorite/{id}' , [App\Http\Controllers\FavoriteProductController::class , 'Delete_Favorite']);
        Route::post('/FavoriteStore/Add_Favorite/{id}' , [App\Http\Controllers\FavoriteStoreController::class , 'Add_Favorite']);
        Route::get('/FavoriteStore/Show_Favorite' , [App\Http\Controllers\FavoriteStoreController::class , 'Show_Favorite']);
        Route::delete('/FavoriteStore/Delete_Favorite/{id}' , [App\Http\Controllers\FavoriteStoreController::class , 'Delete_Favorite']);


        ;});
