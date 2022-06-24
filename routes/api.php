<?php

use App\Http\Controllers\StoreController;

use Illuminate\Support\Facades\Route;



Route::post('store/create', [App\Http\Controllers\StoreController::class, 'store']);
Route::post('storeManager/register', [App\Http\Controllers\StoreManagerController::class, 'register']);

Route::post('collection/create', [App\Http\Controllers\CollectionController::class, 'store']);
Route::get('collection/collectionNane/{id}', [App\Http\Controllers\CollectionController::class, 'collectionNane']);
Route::put('collection/update', [App\Http\Controllers\CollectionController::class, 'update']);
Route::put('collection/delete', [App\Http\Controllers\CollectionController::class, 'delete']);
Route::get('collection/getCollectionId', [App\Http\Controllers\CollectionController::class, 'getCollectionId']);
Route::get('collection/index/{id}', [App\Http\Controllers\CollectionController::class, 'index']);


Route::get('classification/show', [App\Http\Controllers\ClassificationController::class, 'Show_Classification']);

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

