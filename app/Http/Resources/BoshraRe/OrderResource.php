<?php

namespace App\Http\Resources\BoshraRe;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'store_id' => $this->store_id ,
            'customer_id' => $this->customer_id ,
            'order_id' => $this->id ,
            'created_at' => $this->created_at->format('Y-m-d '),
            'updated_at' => $this->updated_at->format('Y-m-d '),
        ];
    }
}
