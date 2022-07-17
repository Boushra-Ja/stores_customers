<?php

namespace App\Http\ResourcesBayan;

use App\Models\Customer;
use App\Models\Persone;
use Illuminate\Http\Resources\Json\JsonResource;

class myorderResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'delivery_time' => $this->delivery_time,
            'delivery_price' => $this->delivery_price,
            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at->format('Y-m-d '),
            'customer_name' => Persone::where('id', '=', Customer::where('id', '=', $this->customer_id)->value('persone_id'))->value('name'),
        ];
    }
}
