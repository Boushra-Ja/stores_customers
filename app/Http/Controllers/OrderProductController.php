<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\ordure_product_resource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Http\Resources\BoshraRe\BillResource;
use App\Http\Resources\BoshraRe\OrderProductResource;
use App\Http\Resources\BoshraRe\ProductBillResource;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

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
            return $this->sendResponse(OrderProductResource::collection($arr), "success");
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

    public function bill($order_id)
    {

        $data =  DB::table('order_products')->where('order_products.order_id' ,$order_id )
        ->join('orders', 'orders.id', '=', 'order_products.order_id')
        ->get() ;

        return $this->sendResponse(BillResource::collection($data ), 'success') ;
    }

/*
public function all_products_bill($order_id)
    {
        $products  =OrderProduct::where('order_id' , $order_id)->get() ;
        return $this->sendResponse(ProductBillResource::collection($products) , 'success') ;

    }
  */



    public function order_product($id){
        $product=OrderProduct::where('order_id','=',$id)->get();
        $g = ordure_product_resource::collection($product);

        return $this->sendResponse($g, 'Store Shop successfully');
    }

    public function all_orderproduct($order_id , $status_id)
    {
        $data = OrderProduct::where('order_id' , $order_id)->where('status_id' , $status_id ) ->get() ;
        return $this->sendResponse(OrderProductResource::collection($data) , 'success') ;
    }
}
