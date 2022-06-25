<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBat\OrderCollectionB;
use App\Http\ResourcesBayan\ordure_product_resource;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Models\OrderStatus;

class OrderProductController extends BaseController
{


    ////////التأكد أن الطلب في السلة
    public function check_of_order($product_id, $order_id)
    {
        $data = OrderProduct::where('product_id', $product_id)->where('order_id', $order_id)->where('status_id', OrderStatus::where('status', 'في السلة')->value('id'))->first();
        if ($data) {
            return  1;
        }
        return 0;
    }

    public function index()
    {
        $status_id = OrderStatus::where('status', 'في السله')->value('id');

        $order=OrderProduct::query()->where('status_id',$status_id)->get();

        if ($order) {
            return

                OrderCollectionB::collection($order);
        } else {


            return null;
        }

        /////////////////////////////////

//        dd("jjj");

//
//        $order = OrderProduct::with('orders')->where('status_id','=',5)->
//        get();



       // return response()->json($order,200);


    }




    //////اضافة المنتج الى السلة
    public function store(StoreOrderProductRequest $request)
    {

        $orderProduct = OrderProduct::Create([
            'product_id' => $request->product_id,
            'status_id' => OrderStatus::where('status', 'في السلة')->value('id'),
            'order_id' => $request->order_id,
        ]);

        $arr = [$orderProduct];

        if ($arr) {
            return $this->sendResponse($arr, "success");
        }
        return $this->sendErrors([], "error");
    }



    //////حذف المنتج من السلة
    public function destroy($orderProduct)
    {
        $res = OrderProduct::where('id', $orderProduct)->delete();
        if ($res)
            return $this->sendResponse($res, "success");
        else
            return $this->sendErrors([], "failed");
    }

    public function order_product($id){
        $product=OrderProduct::where('order_id','=',$id)->get();
        $g = ordure_product_resource::collection($product);

        return $this->sendResponse($g, 'Store Shop successfully');
    }
}
