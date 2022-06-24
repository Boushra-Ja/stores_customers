<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'store_id' => $this->store_id ,
            'store_name' => Store::where('id' ,$this->store_id )->value('name') ,
            'customer_id' => $this->customer_id ,
            'order_id' => $this->id ,
            'delivery_time' => $this->delivery_time ,
        //    'created_at' => $this->created_at->format('Y-m-d '),
          //  'updated_at' => $this->updated_at->format('Y-m-d '),
        ];
    }
}
