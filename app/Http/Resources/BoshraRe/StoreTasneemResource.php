<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Collection;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Persone;
use App\Models\Product;
use App\Models\StoreManager;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTasneemResource extends JsonResource
{

    public function toArray($request)
    {
        $Collection = Collection::where('store_id' , $this->id) ->get();
        $sum = 0 ;
        foreach ($Collection as $val) {

            $sum = $sum + Product::where("collection_id",$val['id'])->count();
        }

        $orders = Order::where('store_id' , $this->id)->get() ;
        $orders_recieved = 0 ;
        foreach ($orders as  $value) {
            $orders_recieved = $orders_recieved + OrderProduct::where('order_id' , $value['id'])->where('status_id' , OrderStatus::where('status' , 'تم التسليم')->value('id'))->count();
        }

        $orders_accepted = 0 ;
        foreach ($orders as  $value) {
            $orders_accepted = $orders_accepted + OrderProduct::where('order_id' , $value['id'])->where('status_id' , OrderStatus::where('status' , 'تم القبول')->value('id'))->count();
        }

        return  [

            'store_id' => $this->id ,
            'shop_name' => $this->name ,
            'discription' => $this->discription ,
            'status' => $this->status ,
            'email' => Persone::where('id' , StoreManager::where('store_id' , $this->id)->value('person_id'))->value('email') ,
            'num_products' => $sum,
            'orders_recieved' => $orders_recieved ,
            'orders_accepted' => $orders_accepted ,

        ];
    }
}
