<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Order;
use App\Models\Persone;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CustomerResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'customer_id' => $this->id ,
            'customer_name' => Persone::where('id' , $this->persone_id)->value('name'),
            'created_at' => $this->created_at->format('Y-m-d '),
            'num_orders'  =>Order::where("customer_id",$this->id)->count()
        ];
    }
}
