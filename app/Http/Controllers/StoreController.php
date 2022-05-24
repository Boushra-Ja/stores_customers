<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\BoshraRe\StoreResource;
use App\Http\Resources\BoshraRe\StoresResource;
use App\Models\Collection;

class StoreController extends BaseController
{

    ////عرض جميع المتاجر
    public function index()
    {
        $stores = Store::all() ;
        return $this->sendResponse( StoreResource::collection($stores), "تمت عملية عرض المتاجر بنجاح") ;
    }


    ////عرض المنتجات الأكثر تقييماً
    public function order_by_review()
    {
        $stores = DB::table('rating_stores')
        ->select([DB::raw("SUM(value) as value") , DB::raw("store_id") ,DB::raw("count(value) as num_customer")])
        ->groupBy('store_id');

        $all_data = DB::table('stores')
                ->joinSub($stores, 'rating_stores', function ($join) {
                    $join->on('stores.id', '=', 'rating_stores.store_id');
                })->select(['stores.*','rating_stores.*'])->get();

        if($all_data)
        {
            return $this->sendResponse(StoresResource::collection($all_data), "تم إرجاع المتاجر من الأعلى تقييما الى الأقل تقييما") ;
        }
        return $this->sendErrors("مشكلة في ترتيب المتاجر") ;
    }

    ////عرض المنتجات الأكثر مبيعاً
    public function order_by_sales()
    {
        $data = Store::select("*")->orderBy('num_of_salling' , 'DESC')->get();
        return $this->sendResponse(StoresResource::collection($data),"تم ارجاع المتاجر حسب الاكثر مبيعاً") ;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        ///////بيان هاد كود للتجريب فيكي تحذفيه وتكتبي يلي بدك
        $input = $request->all() ;
        $shop = Store::create($input) ;

        if ($shop) {
            return $this->sendResponse($shop, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }
    }


    ////عرض متجر محدد
    public function show( $id)
    {
        $data = Store::where('id' , $id)->get();
        if ($data) {
            return $this->sendResponse(StoreResource::collection($data), 'تم ارجاع ملف المتجر بنجاح');
        } else {
            return $this->sendErrors('خطأ في عرض بروفايل المتجر', ['error' => 'error in show store profile']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
