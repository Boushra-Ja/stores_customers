<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\orderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{

    /////جميع الطلبات
    public function index()
    {
        $orders = Order::all() ;
        if($orders)
        {
            return $this->sendResponse($orders , "sucess") ;
        }

        return  $this->sendErrors([] , 'failed')     ;

    }


    ////////التأكد أن الطلب موجود
    public function check_of_order($customer_id , $store_id)
    {
        $data = Order::where('customer_id' , $customer_id)->where('store_id' , $store_id)->first();
        if($data)
        {
            return  $data->id ;
        }
        return 0 ;

    }


    //////////جميع الطلبات المقبولة
    public function acceptence_orders()
    {
        $status_id = OrderStatus::where('id' ,1)->value('id') ;

        $orders = Order::where('status_id' , $status_id)->get() ;

        return $this->sendResponse($orders , 'success');


    }


    public function store(StoreOrderRequest $request)
    {
        $order = Order::where('store_id', '=', $request->store_id)-> where('customer_id', '=', $request->customer_id)->first();
        if ($order === null) {

            $order = Order::firstOrCreate([
                'store_id' => $request->store_id,
                'customer_id' => $request->customer_id,
                'delivery_time' => $request->delivery_time,
                'delivery_price' => $request->delivery_price,
              ]);

        }

        $arr = [$order] ;
        return $this->sendResponse( OrderResource::collection($arr) , 'success');

    }

    //الطلبات المعلقة/المنفذة/المقبولة لمتجر
    public function all_my_order($id,$i){

        $order= DB::table('orders')->join('order_products',function ($join) use ($i) {
            $join->on('order_products.order_id','=','orders.id')->where('order_products.status_id','=',$i);
        })->where('orders.store_id','=',$id )->get();

        $g = orderResource::collection($order);

        return $this->sendResponse($g, 'Store Shop successfully');
    }
}
