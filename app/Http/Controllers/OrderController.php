<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\orderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\BoshraRe\OrderProductResource;
use App\Http\Resources\BoshraRe\OrdersResource;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{

    /////جميع الطلبات
    public function index()
    {
        $orders = Order::all();
        if ($orders) {
            return $this->sendResponse($orders, "sucess");
        }

        return  $this->sendErrors([], 'failed');
    }

 ////////التأكد أن الطلب موجود
    public function check_of_order($customer_id, $store_id)
    {
        $data = Order::where('customer_id', $customer_id)->where('store_id', $store_id)->first();
        if ($data) {
            return  $data->id;
        }
        return 0;
    }
    public function store(StoreOrderRequest $request)
    {
        $order = Order::where('store_id', '=', $request->store_id)-> where('customer_id', '=', $request->customer_id)->first();
        if ($order === null) {

            $order = Order::firstOrCreate([
                'store_id' => $request->store_id,
                'customer_id' => $request->customer_id,
                'delivery_time' => "2022-06-25 16:39:06",
                'delivery_price' => 0,
            ]);

        }

        $arr = [$order] ;
        return $this->sendResponse( OrdersResource::collection($arr) , 'success');

    }




    //////////جميع الطلبات المقبولة
    public function acceptence_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0 ;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i]  = OrderProduct::where('order_id', $value['id'])-> where('status_id' , OrderStatus::where('status' , 'مقبول')->value('id'))->get();

            foreach ($temp[$i] as  $val) {
                $res[$j] = $val ;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res) , 'successs');

    }

    //////الطلبات المعلقة
    public function waiting_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0 ;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i]  = OrderProduct::where('order_id', $value['id'])-> where('status_id' , OrderStatus::where('status' , 'معلق')->value('id'))->get();

            foreach ($temp[$i] as  $val) {
                $res[$j] = $val ;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res) , 'successs');
    }

    ///الطلبات المسلمة
    public function received_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0 ;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i]  = OrderProduct::where('order_id', $value['id'])-> where('status_id' , OrderStatus::where('status' , 'تم التسليم')->value('id'))->get();

            foreach ($temp[$i] as  $val) {
                $res[$j] = $val ;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res) , 'successs');
    }
    //الطلبات المعلقة/المنفذة/المقبولة لمتجر
    public function all_my_order($id,$i){

        $order= DB::table('orders')->join('order_products',function ($join) use ($i) {
            $join->on('order_products.order_id','=','orders.id')->where('order_products.status_id','=',$i);
        })->where('orders.store_id','=',$id )->get();

        $g = OrdersResource::collection($order);

        return $this->sendResponse($g, 'Store Shop successfully');
    }
}
