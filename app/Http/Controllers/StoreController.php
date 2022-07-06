<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\BoshraRe\StoreResource;

class StoreController extends BaseController
{

    ////عرض جميع المتاجر
    public function index()
    {
        $stores = Store::all();
        return $this->sendResponse(StoreResource::collection($stores), "تمت عملية عرض المتاجر بنجاح");
    }

    ////عرض المنتجات الأكثر تقييماً
    public function order_by_review()
    {
        $stores = DB::table('rating_stores')
            ->select([DB::raw("SUM(value) as value"), DB::raw("store_id"), DB::raw("count(value) as num_customer")])
            ->groupBy('store_id');

        $all_data = DB::table('stores')
            ->joinSub($stores, 'rating_stores', function ($join) {
                $join->on('stores.id', '=', 'rating_stores.store_id');
            })->select(['stores.*', 'rating_stores.*'])->get();

        if ($all_data) {
            return $this->sendResponse(StoreResource::collection($all_data), "تم إرجاع المتاجر من الأعلى تقييما الى الأقل تقييما");
        }
        return $this->sendErrors("مشكلة في ترتيب المتاجر");
    }

    ////عرض المنتجات الأكثر مبيعاً
    public function order_by_sales()
    {
        //[DB::raw('id' ),DB::raw('name' ),DB::raw('image' ),DB::raw('num_of_salling' )]
        $data = Store::select("*")->orderBy('num_of_salling', 'DESC')->get();
        return $this->sendResponse(StoreResource::collection($data), "تم ارجاع المتاجر حسب الاكثر مبيعاً");
    }

    /////انشاء متجر
    public function store(StoreStoreRequest $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'discription' => ['required', 'string'],
            'delivery_area' => ['required', 'string'],
            'image',
            'Brand',
            'facebook',
            'mobile',
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/books/', $filename);
            $request->image = $filename;

        } else
            $request->image = '';

        if ($request->hasfile('Brand')) {
            $file1 = $request->file('Brand');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '.' . $extention1;
            $file1->move('uploads/books/', $filename1);
            $request->Brand = $filename1;

        } else
            $request->Brand = '';

        $input = $request->all();
        $shop = Store::create($input);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/stores/', $filename);
            $shop->image = $filename;

        } else
            $shop->image = '';
        $shop->save();

        if ($shop) {
            WaitingStoreController::store($shop->id);

            DiscountController::store($request,$shop->id,1);

            StoreManagerController::register($request,$shop->id);
            return $this->sendResponse($shop->id, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }

    }

    ////عرض متجر محدد
    public function show($id)
    {
        $store = Store::find($id);
        return $this->sendResponse($store, 'تم ارجاع ملف المتجر بنجاح');

    }

    ////////تعديل بيانات المتجر
    public function update(Request $request)
    {
        $store = Store::find($request->store)->update($request->all());
        return $this->sendResponse($store, 'تم تعديل ملف المتجر بنجاح');


    }

}
