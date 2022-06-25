<?php

use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\FavoriteStoreController;
use App\Http\Controllers\OptioinValueController;
use App\Http\Controllers\OptionTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderStatuseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\RatingStoreController;
use App\Http\Controllers\SecondrayClassificationController;
use App\Http\Controllers\StoreController;
use App\Models\Product;
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
Route::resource('order_product' , OrderProductController::class)->except('edit' , 'index' , 'update' , 'create');
Route::resource('option_product' , ProductOptionController::class);
Route::get('orders/check/{id}/{id2}' , [OrderController::class , 'check_of_order']);
Route::get('product_orders/check/{id}/{id2}' , [OrderProductController::class , 'check_of_order']);

////Routes for order
Route::resource('order_status', OrderStatuseController::class);
//Route::resource('accept_orders' , [OrderController::class , 'acceptence_orders']);



/////////Option_product
Route::get('option_for_product/{id}' , [OptionTypeController::class , 'option_product']);
Route::get('values_for_option/{id}' , [OptioinValueController::class , 'options_type_with_value']);

/////////add_product
Route::post('temp' , [ProductController::class , 'temp']) ;

/////////My_Favourite_store
Route::get('myFavorite/{id}' , [FavoriteStoreController::class , 'myFavorite']);

////////////////////////******////////////////////////////////////


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











/////////////////////batool/////////

Route::prefix("Customer") ->group(function() {
    Route::post('/html_email/{name}/{code}/{email}/{title}', 'App\Http\Controllers\CustomerController@html_email');
    Route::post('/changepassword' ,'App\Http\Controllers\CustomerController@changepassword');
    Route::post('/login', 'App\Http\Controllers\CustomerController@login');
    Route::post('/logout', 'App\Http\Controllers\CustomerController@logout');
    Route::post('/register', 'App\Http\Controllers\CustomerController@register');

});
//, 'middleware' => ['auth:sanctum']


Route::get('/Show_p' , [App\Http\Controllers\SecondrayClassificationController::class,'Show_p']);

Route::group(['prefix' => 'Product'],  function() {

    Route::post('/temp' , [ProductController::class,'temp']) ;
    Route::get('/Order_sales' , [ProductController::class,'Order_sales']);
    Route::get('/Order_discount' , [ProductController::class,'Order_discount']);
    Route::get('/Order_Salary' , [ProductController::class,'Order_Salary']);
    Route::get('/Order_favorite' , [ProductController::class,'Order_favorite']);
    Route::get('/Product/Product_All' , [ProductController::class,'Product_All']);
    Route::get('/Product_All' , [ProductController::class,'Product_All']);
    Route::get('/Product_Allf' , [ProductController::class,'Product_Allf']);
    Route::post('/P2' ,[ProductController::class, 'store']);
    Route::get('/Show_Secondray' , [SecondrayClassificationController::class,'Show_Secondray']);
    Route::get('/ShowClassification2/{id}' , [SecondrayClassificationController::class,'ShowClassification2']);
    Route::get('/Show_Detalis/{id}' , [ProductController::class,'Show_Detalis']);


});

Route::prefix("FavoriteProduct")->namespace('App\Http\Controllers')->group(function() {
        Route::get('/index' , 'FavoriteProductController@index');
        Route::resource('f' , 'FavoriteProductController');
        Route::get('/show' , 'FavoriteProductController@Show');
        Route::post('/store/{id}' , 'FavoriteProductController@store');
      //  Route::get('index' , 'FavoriteStoreController@index');

});


//,'middleware' => ['auth:sanctum']
Route::prefix("FavoriteStore")->namespace('App\Http\Controllers')->group(function() {

    Route::post('/Add_Favorite/{id}' , 'App\Http\Controllers\FavoriteStoreController@Add_Favorite');
    Route::get('/Show_Favorite' , 'App\Http\Controllers\FavoriteStoreController@Show_Favorite');
    Route::get('/index' , 'App\Http\Controllers\FavoriteStoreController@index');
    Route::resource('f2' , 'FavoriteStoreController');


});


Route::prefix("SecondrayClassification") ->group(function() {

Route::post('/ShowClassification/{id}/{title}' , 'App\Http\Controllers\SecondrayClassificationController@shwoo');

});


Route::get('/index' , [App\Http\Controllers\OrderProductController::class,'index']);












//Route::group(['middleware' => ['auth:sanctum']],
//    function () {
//
//});


