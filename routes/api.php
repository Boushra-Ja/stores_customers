<?php

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
use App\Models\Product;
use Illuminate\Support\Facades\Route;


//////////////////Boushra//////////////////////////////
////Route Of Stores
Route::resource('stores' , StoreController :: class) ;
Route::get('stores/order/reviews' , [StoreController::class , 'order_by_review']) ;
Route::get('stores/order/sales' , [StoreController::class , 'order_by_sales']) ;

///add favourite store
Route::post('FavoriteStore/Add_Favorite' , [FavoriteStoreController::class , 'Add_Favorite']);
Route::delete('FavoriteStore/Delete_Favorite/{id}/{cus_id}' , [FavoriteStoreController::class , 'Delete_Favorite']);
Route::get('product_with_class/{id}' , [StoreController::class , 'product_with_class']);


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
Route::get('accept_orders/{id}' , [OrderController::class , 'acceptence_orders']);
Route::get('waiting_orders/{id}' , [OrderController::class , 'waiting_orders']);
Route::get('received_orders/{id}' , [OrderController::class , 'received_orders']);
Route::get('order_product/options/{id}' ,[ProductOptionController::class , 'get_options']);
Route::post('orderproduct/update/{id}' ,[ProductOptionController::class , 'update_choice'] );

/////////Option_product
Route::get('option_for_product/{id}' , [OptionTypeController::class , 'option_product']);
Route::get('values_for_option/{id}' , [OptioinValueController::class , 'options_type_with_value']);

/////////add_product
Route::post('temp' , [ProductController::class , 'temp']) ;
Route::get('my_product_store/{store_id}' , [ProductController::class , 'my_product']) ;

/////////My_Favourite_store
Route::get('myFavorite/{id}' , [FavoriteStoreController::class , 'myFavorite']);

/////bill
Route::get('bill/{id}' , [OrderProductController::class , 'bill']);
Route::get('all_products_bill/{id}' , [OrderProductController::class , 'all_products_bill']);
Route::get('all_orderproduct/{id}/{status_id}' , [OrderProductController::class , 'all_orderproduct']);


////////////////////////******////////////////////////////////////


Route::post('store/create', [App\Http\Controllers\StoreController::class, 'store']);
Route::post('storeManager/register', [App\Http\Controllers\StoreManagerController::class, 'register']);

Route::post('collection/create', [App\Http\Controllers\CollectionController::class, 'store']);
Route::get('collection/collectionNane/{id}', [App\Http\Controllers\CollectionController::class, 'collectionNane']);
Route::put('collection/update', [App\Http\Controllers\CollectionController::class, 'update']);
Route::put('collection/delete', [App\Http\Controllers\CollectionController::class, 'delete']);
Route::get('collection/getCollectionId', [App\Http\Controllers\CollectionController::class, 'getCollectionId']);
Route::get('collection/index/{id}', [App\Http\Controllers\CollectionController::class, 'index']);


Route::get('classification/show', [App\Http\Controllers\ClassificationController::class, 'Show_Classification']);

Route::post('option_types/create', [App\Http\Controllers\OptionTypeController::class, 'stor1']);

Route::post('product/create', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('product/index', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('product/show', [App\Http\Controllers\ProductController::class, 'show']);

Route::post('store/update', [App\Http\Controllers\StoreController::class, 'update']);
Route::get('store/show/{id}', [App\Http\Controllers\StoreController::class, 'show']);

Route::get('storeManager/index/{id}', [App\Http\Controllers\StoreManagerController::class, 'index']);


Route::post('helper/create', [App\Http\Controllers\HelperController::class, 'store']);
Route::post('storeManager/update', [App\Http\Controllers\StoreManagerController::class, 'update']);

Route::post('discountproduct/create', [App\Http\Controllers\DiscountController::class, 'store']);
Route::post('customer/register', [App\Http\Controllers\CustomerController::class, 'register']);
Route::get('order/all_my_order/{id}', [App\Http\Controllers\OrderController::class, 'all_my_order']);
Route::get('order/order_product/{id}', [App\Http\Controllers\OrderProductController::class, 'order_product']);

Route::get('customer/myCustomer/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer']);
Route::get('customer/myCustomer_most_buy/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer_most_buy']);
Route::get('customer/myCustomer_salles/{id}', [App\Http\Controllers\CustomerController::class, 'myCustomer_salles']);

Route::post('Customer/login', [App\Http\Controllers\CustomerController::class, 'login']);
