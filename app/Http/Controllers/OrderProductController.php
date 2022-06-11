<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
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
}
