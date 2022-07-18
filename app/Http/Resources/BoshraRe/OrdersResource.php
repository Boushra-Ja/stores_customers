<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Customer;
use App\Models\Persone;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'customer' => Persone::where('id','=',Customer::where('id','=',$this->customer_id)->value('persone_id'))->value('name'),
            'order_id' => $this->id,
            'delivery_time' => $this->delivery_time,
            'created_at' => $this->created_at,
            'discount_codes_id' => $this->discount_codes_id
        ];
    }
}
