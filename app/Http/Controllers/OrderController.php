<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\ResourcesBayan\myorderResource;
use App\Models\Discount;
use App\Models\DiscountCode;
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
    ///boshra
    public function index()
    {
        $orders = Order::all();
        if ($orders) {
            return $this->sendResponse($orders, "sucess");
        }

        return $this->sendErrors([], 'failed');
    }

    ////////التأكد أن الطلب موجود
    //boshra
    public function check_of_order($customer_id, $store_id)
    {

        $data = Order::where('customer_id', $customer_id)->where('store_id', $store_id)->first();
        if ($data) {
            return $data->id;
        }
        return 0;
    }


    //boshra
    public function store(StoreOrderRequest $request)
    {
        $order = Order::where('store_id', '=', $request->store_id)->where('customer_id', '=', $request->customer_id)->first();
        $code = DiscountCode::where('discounts_id', '=', Discount::where('store_id', '=', $request->store_id)->where('value', '=', 0)->value('id'))->value('id');

        if ($order === null) {

            $order = Order::firstOrCreate([
                'store_id' => $request->store_id,
                'customer_id' => $request->customer_id,
                'delivery_time' => "2022-06-25 16:39:06",
                'delivery_price' => 0,
                'discount_codes_id' => $code
            ]);

        }

        $arr = [$order];
        return $this->sendResponse(OrdersResource::collection($arr), 'success');

    }


    //////////جميع الطلبات المقبولة
    ///boshra
    public function acceptence_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i] = OrderProduct::where('order_id', $value['id'])->where('status_id', OrderStatus::where('status', 'مقبول')->value('id'))->get();

            foreach ($temp[$i] as $val) {
                $res[$j] = $val;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res), 'successs');

    }

    //////الطلبات المعلقة
    ///boshra
    public function waiting_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i] = OrderProduct::where('order_id', $value['id'])->where('status_id', OrderStatus::where('status', 'معلق')->value('id'))->get();

            foreach ($temp[$i] as $val) {
                $res[$j] = $val;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res), 'successs');
    }

    ///الطلبات المسلمة
    ///boshra
    public function received_orders($customer_id)
    {
        $orders = Order::select('id')->where('customer_id', $customer_id)->get();

        $temp = array();
        $res = array();

        $j = 0;
        $i = 0;
        foreach ($orders as $value) {
            $temp[$i] = OrderProduct::where('order_id', $value['id'])->where('status_id', OrderStatus::where('status', 'تم التسليم')->value('id'))->get();

            foreach ($temp[$i] as $val) {
                $res[$j] = $val;
                $j++;
            }
            $i++;

        }

        return $this->sendResponse(OrderProductResource::collection($res), 'successs');
    }


    ///عرض الطلبات
    /// bayan
    public static function orderstatus($store_id, $id)
    {
        if ($id == 1) {
            $s = OrderStatus::where('status', '=', 'معلق')->value('id');
        } else if ($id == 2) {
            $s = OrderStatus::where('status', '=', 'مقبول')->value('id');
        } else if ($id == 3) {
            $s = OrderStatus::where('status', '=', 'مسلم')->value('id');
        }

        $g = OrderController::all_my_order($store_id, $s);

        return $g;


    }
    //الطلبات المعلقة/المنفذة/المقبولة لمتجر
    //bayan
    public static function all_my_order($id, $i)
    {

        $order = DB::table('orders')->join('order_products', function ($join) use ($i) {
            $join->on('order_products.order_id', '=', 'orders.id')->where('order_products.status_id', '=', $i);
        })->where('orders.store_id', '=', $id)->get();


        $o = $order->groupBy('order_id');
        $i = 0;


        $g = array();
        foreach ($o as $v) {
            foreach ($v as $value) {
                $g[$i] = myorderResource::make($value);
                $i += 1;
                break;

            }
        }


        return $g;
    }

    //bayan
    public static function dash_bord_art($store_id)
    {
        $s = OrderStatus::where('status', '=', 'مسلم')->value('id');

        $order = DB::table('orders')->join('order_products', function ($join) use ($s) {
            $join->on('order_products.order_id', '=', 'orders.id')->where('order_products.status_id', '=', $s);
        })->where('orders.store_id', '=', $store_id)->get();


        $o = $order->groupBy('delivery_time');
//        $i = 0;
//
//        $g = array();
//        foreach ($o as $v) {
//            foreach ($v as $value) {
//                $g[$i] = myorderResource::make($value);
//                $i += 1;
//                break;
//
//            }
//        }


        return $o;
    }



    //bayan
    public function accept_order($id)
    {
        $s = OrderStatus::where('status', '=', 'مقبول')->value('id');
        $order = OrderProduct::where('order_id', '=', $id)->get();
        foreach ($order as $value) {
            $value->update(['status_id' => $s]);
        }
    }

    //bayan
    public function delete_order($id)
    {
        $s = OrderStatus::where('status', '=', 'مرفوض')->value('id');
        $order = OrderProduct::where('order_id', '=', $id)->get();
        foreach ($order as $value) {
            $value->update(['status_id' => $s]);
        }
    }

    //bayan
    public function deliver_order($id)
    {
        $s = OrderStatus::where('status', '=', 'مسلم')->value('id');
        $order = OrderProduct::where('order_id', '=', $id)->get();
        foreach ($order as $value) {
            $value->update(['status_id' => $s]);
        }
    }


}
