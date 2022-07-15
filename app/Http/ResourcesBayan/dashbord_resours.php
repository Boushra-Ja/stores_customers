<?php

namespace App\Http\ResourcesBayan;

use App\Http\Controllers\CollectionController;

use App\Http\Controllers\OrderController;

use App\Models\Order;

use App\Models\RatingStore;
use Illuminate\Http\Resources\Json\JsonResource;

class dashbord_resours extends JsonResource
{


    public function toArray($request)
    {

        $order_r = OrderController::orderstatus($this->resource, 1);
        $order_recev = count($order_r);
        $order_ac = OrderController::orderstatus($this->resource, 2);
        $order_accept = count($order_ac);
        $product = CollectionController::index($this->resource);
        $product_count = count($product);
        $order_delever = OrderController::orderstatus($this->resource, 3);


        ///customer order total
        $order = Order::where('store_id', '=', $this->resource)->get();

        $d = $order->groupBy('customer_id');


        $customer = customerResource::collection($d);

        $rat=RatingStore::where('store_id','=',$this->resource)->get();
        $rating=count($rat);

        //    $customer = discountCodeResource::collection($d);


        return [
            'order_recev_count' => $order_recev,
            'order_accept_count' => $order_accept,
            'product_count' => $product_count,
            'order_recev' => $order_r,
            'order_accept' => $order_ac,
            'order_delever' => $order_delever,
            'customer' => $customer,
            'rating'=>$rating
        ];
    }

}
