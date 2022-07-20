<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountCustomerController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\SecondrayClassificationController;
use App\Http\Controllers\StoreController;
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
use App\Http\Controllers\ReportController;
use App\Models\DiscountCustomer;
use App\Models\FavoriteProduct;
use App\Models\OptioinValue;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


//////////////////Boushra//////////////////////////////
////Route Of Stores
Route::resource('stores', StoreController :: class);
Route::get('stores/order/reviews', [StoreController::class, 'order_by_review']);
Route::get('stores/order/sales', [StoreController::class, 'order_by_sales']);

///add favourite store
Route::post('FavoriteStore/Add_Favorite', [FavoriteStoreController::class, 'Add_Favorite']);
Route::delete('FavoriteStore/Delete_Favorite/{id}/{cus_id}', [FavoriteStoreController::class, 'Delete_Favorite']);
Route::get('product_with_class/{id}', [StoreController::class, 'product_with_class']);


////Routes for products
Route::resource('products', ProductController::class);
Route::get('similar_products/{id}', [ProductController::class, 'similar_products']);


/////Routes for rating products
Route::resource('rating_product', ProductRatingController::class)->except('show', 'edit', 'destroy', 'update');
Route::get('isRating/product/{pr_id}/{cus_id}', [ProductRatingController::class, 'isRating']);

/////Routes for rating stors
Route::resource('rating_store', RatingStoreController::class)->except('show', 'edit', 'destroy', 'update');
Route::get('isRating/store/{store_id}/{cus_id}', [RatingStoreController::class, 'isRating']);

/////Routes for Orders
Route::resource('orders', OrderController::class);
Route::resource('order_product', OrderProductController::class)->except('edit', 'index', 'update', 'create');
Route::resource('option_product', ProductOptionController::class);
Route::get('orders/check/{id}/{id2}', [OrderController::class, 'check_of_order']);
Route::get('product_orders/check/{id}/{id2}', [OrderProductController::class, 'check_of_order']);

////Routes for order
Route::resource('order_status', OrderStatuseController::class);
Route::get('accept_orders/{id}', [OrderController::class, 'acceptence_orders']);
Route::get('waiting_orders/{id}', [OrderController::class, 'waiting_orders']);
Route::get('received_orders/{id}', [OrderController::class, 'received_orders']);
Route::get('order_product/options/{id}', [ProductOptionController::class, 'get_options']);
Route::post('orderproduct/update/{id}', [ProductOptionController::class, 'update_choice']);

/////////Option_product
Route::get('option_for_product/{id}', [OptionTypeController::class, 'option_product']);
Route::get('values_for_option/{id}', [OptioinValueController::class, 'options_type_with_value']);

/////////add_product
Route::post('temp', [ProductController::class, 'temp']);
Route::get('my_product_store/{store_id}', [ProductController::class, 'my_product']);

/////////My_Favourite_store
Route::get('myFavorite/{id}', [FavoriteStoreController::class, 'myFavorite']);

//////add favourite prodcut
Route::post('FavoriteProduct/Add_Favorite/{id}', [FavoriteProductController::class, 'store']);
Route::get('isFavourite/product/{product_id}/{customer_id}', [FavoriteProductController::class, 'isFavourite']);

/////bill
Route::get('bill/{id}', [OrderProductController::class, 'bill']);
Route::get('all_products_bill/{id}', [OrderProductController::class, 'all_products_bill']);
Route::get('all_orderproduct/{id}/{status_id}', [OrderProductController::class, 'all_orderproduct']);
Route::post('edit/order_product', [OrderProductController::class, 'edit_order_product']);
Route::delete('delete/wating_order/{id}', [OrderProductController::class, 'delete_wating_order']);
Route::get('discounts_codes/{id}' , [DiscountCustomerController ::class , 'myDiscount']) ;
////edit profile
Route::post('edit_profile/{id}', [CustomerController::class, 'EditMyProfile']);

//////report on store
Route::post('report', [ReportController::class, 'store']);
Route::get('shop_names', [StoreController::class, 'shop_names']);

/////search_product
//Route::get('search_product/{name}' , [SearchController::class , 'query']) ;
Route::get('search/product/{name}', [ProductController::class, 'search_by_name']);

/////search_product
Route::get('search/store/{name}', [StoreController::class, 'search_by_name']);

//////All_material
Route::get('All_material', [OptioinValueController::class, 'All_material']);
Route::get('Gift_request/{d1}/{d2}/{d3}/{d4}/{d5}/{d6}', [ProductController::class, 'Gift_request']);

/////////////tasnem////////////////
Route::get("allCustomer" , [CustomerController::class , 'allCustomers']) ;


//////////////////////////////////////////////////////////////
/////////////////////batool_new/////////

Route::prefix("Customer")->group(function () {
    Route::post('/html_email/{name}/{code}/{email}/{title}', 'App\Http\Controllers\CustomerController@html_email');
    Route::post('/changepassword', 'App\Http\Controllers\CustomerController@change_password');
    Route::post('/login', 'App\Http\Controllers\CustomerController@login');
    Route::post('/logout', 'App\Http\Controllers\CustomerController@logout');
    Route::post('/register', 'App\Http\Controllers\CustomerController@register');

});
//, 'middleware' => ['auth:sanctum']


Route::get('/Show_p', [App\Http\Controllers\SecondrayClassificationController::class, 'Show_p']);

Route::group(['prefix' => 'Product'], function () {

    Route::post('/temp', [ProductController::class, 'temp']);
    Route::get('/Order_sales', [ProductController::class, 'Order_sales']);
    Route::get('/Order_discount', [ProductController::class, 'Order_discount']);
    Route::get('/Order_Salary', [ProductController::class, 'Order_Salary']);
    Route::get('/Order_favorite', [ProductController::class, 'Order_favorite']);
    Route::get('/Product/Product_All', [ProductController::class, 'Product_All']);
    Route::get('/Product_All', [ProductController::class, 'Product_All']);
    Route::get('/Product_Allf', [ProductController::class, 'Product_Allf']);
    Route::post('/P2', [ProductController::class, 'store']);
    Route::get('/Show_Secondray', [SecondrayClassificationController::class, 'Show_Secondray']);
    Route::get('/ShowClassification2/{id}', [SecondrayClassificationController::class, 'ShowClassification2']);
    Route::get('/ShowClassification/{id}/{title}', [SecondrayClassificationController::class, 'ShowClassification']);
    Route::get('/Show_Detalis/{id}', [ProductController::class, 'Show_Detalis']);


});

Route::prefix("FavoriteProduct")->namespace('App\Http\Controllers')->group(function () {
    Route::get('/index', 'FavoriteProductController@index');
    Route::resource('f', 'FavoriteProductController');
    Route::get('/show', 'FavoriteProductController@Show');
    Route::post('/store/{id}', 'FavoriteProductController@store');
    //  Route::get('index' , 'FavoriteStoreController@index');

});


//,'middleware' => ['auth:sanctum']
Route::prefix("FavoriteStore")->namespace('App\Http\Controllers')->group(function () {

    Route::post('/Add_Favorite/{id}', 'App\Http\Controllers\FavoriteStoreController@Add_Favorite');
    Route::get('/Show_Favorite', 'App\Http\Controllers\FavoriteStoreController@Show_Favorite');
    Route::get('/index', 'App\Http\Controllers\FavoriteStoreController@index');
    Route::resource('f2', 'FavoriteStoreController');


});


Route::prefix("SecondrayClassification")->group(function () {

    Route::post('/ShowClassification/{id}/{title}', 'App\Http\Controllers\SecondrayClassificationController@shwoo');

});


Route::get('/index', [App\Http\Controllers\OrderProductController::class, 'index']);
Route::post('/ChangeToCommit/{productid}/{orderid}', [App\Http\Controllers\OrderProductController::class, 'ChangeToCommit']);
Route::post('/ChangeAmount/{productid}/{orderid}/{amount}', [App\Http\Controllers\OrderProductController::class, 'ChangeAmount']);


///////////////////////////////////////////tasneem//////////////////


Route::prefix("settings")->group(function () {

    Route::post('store/create', [App\Http\Controllers\StoreController::class, 'store']);
    Route::post('person/unique', [App\Http\Controllers\StoreManagerController::class, 'unique_email']);
    Route::post('storeManager/login', [App\Http\Controllers\StoreManagerController::class, 'login']);


    Route::get('store/show/{id}', [App\Http\Controllers\StoreController::class, 'myshow']);
    Route::get('storeManager/index/{id}', [App\Http\Controllers\StoreManagerController::class, 'index']);

    Route::post('store/update', [App\Http\Controllers\StoreController::class, 'update']);
    Route::post('storeManager/true_password', [App\Http\Controllers\StoreManagerController::class, 'true_password']);
    Route::get('PrivilladgeHelperController/my_helper/{id}', [App\Http\Controllers\PrivilladgeHelperController::class, 'my_helper']);


});

Route::prefix("collection")->group(function () {

    Route::post('create', [App\Http\Controllers\CollectionController::class, 'store']);
    Route::get('collectionNane/{id}', [App\Http\Controllers\CollectionController::class, 'collectionNane']);
    Route::post('update', [App\Http\Controllers\CollectionController::class, 'update']);
    Route::post('delete', [App\Http\Controllers\CollectionController::class, 'delete']);
    Route::get('show/{id}', [App\Http\Controllers\CollectionController::class, 'show']);

});

Route::get('SecondrayClassification/list_seconderay', [App\Http\Controllers\SecondrayClassificationController::class, 'list_seconderay']);

Route::prefix("product")->group(function () {

    Route::post('create', [App\Http\Controllers\ProductController::class, 'store']);
    Route::post('delete', [App\Http\Controllers\ProductController::class, 'delete']);
    Route::post('update', [App\Http\Controllers\ProductController::class, 'update']);
    Route::get('index/{id}', [App\Http\Controllers\CollectionController::class, 'index']);
    Route::get('collection/index/{id}', [App\Http\Controllers\CollectionController::class, 'index2']);
    Route::get('show/{id}', [App\Http\Controllers\ProductController::class, 'myshow']);

});

Route::prefix("discountproduct")->group(function () {


    Route::post('create/{id}/{h}', [App\Http\Controllers\DiscountController::class, 'store']);
    Route::post('update', [App\Http\Controllers\DiscountController::class, 'update']);
    Route::get('show/{id}/{type}', [App\Http\Controllers\DiscountController::class, 'show']);
    Route::get('index/{id}', [App\Http\Controllers\DiscountController::class, 'index']);
    Route::get('indexP/{id}', [App\Http\Controllers\DiscountController::class, 'indexP']);
    Route::post('delete', [App\Http\Controllers\DiscountController::class, 'delete']);


});

Route::prefix("myorder")->group(function () {

    Route::get('all_my_order/{store_id}/{id}', [App\Http\Controllers\OrderController::class, 'orderstatus']);
    Route::post('accept_order/{id}', [App\Http\Controllers\OrderController::class, 'accept_order']);
    Route::post('delete_order/{id}', [App\Http\Controllers\OrderController::class, 'delete_order']);
    Route::post('deliver_order/{id}', [App\Http\Controllers\OrderController::class, 'deliver_order']);
    Route::get('order_product/{id}', [App\Http\Controllers\OrderProductController::class, 'order_product']);
    Route::get('bill/{id}/{store_maneger_id}', [App\Http\Controllers\OrderProductController::class, 'mybill']);


});

Route::prefix("mycustomer")->group(function () {


    Route::get('myCustomer/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer']);
    Route::get('myCustomer_most_buy/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer_most_buy']);
    Route::get('myCustomer_salles/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer_salles']);


});


Route::prefix("report")->group(function () {

    Route::get('selles/{id}', [App\Http\Controllers\CollectionController::class, 'selles']);
    Route::get('orders/{id}', [App\Http\Controllers\CollectionController::class, 'orders']);
    Route::get('rate_store/{id}', [App\Http\Controllers\CollectionController::class, 'rate_store']);
    Route::get('rate_product/{id}', [App\Http\Controllers\CollectionController::class, 'rate_product']);


});

Route::get('dashbord/{id}', [App\Http\Controllers\CollectionController::class, 'dashbord']);


Route::prefix("admin")->group(function () {

    Route::post('classification/create', [App\Http\Controllers\ClassificationController::class, 'store']);
    Route::get('classification/Show_Classification', [App\Http\Controllers\ClassificationController::class, 'Show_Classification']);


});

Route::post('Raise/store', [App\Http\Controllers\RaiseController::class, 'store']);
