<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\BoshraRe\OrderProductResource;
use App\Http\Resources\BoshraRe\OrderResource;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if(OrderController:: check_of_order($request->customer_id , $request->store_id) == 0)
        {
            $data = Order::create([
                'customer_id'=>$request->customer_id ,
                'store_id'=>$request->store_id ,
                'delivery_time' => '2022-06-10 13:19:18'

            ]) ;
            if($data)
                return $this->sendResponse( OrderResource::collection([$data]), "success");

            return $this->sendErrors([], "error");

        }
        return $this->sendResponse( OrderResource::collection([Order::where('customer_id',$request->customer_id)->where('store_id',$request->store_id)->first()])  , 'succes') ;
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

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
