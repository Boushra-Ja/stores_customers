<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class RatingResource extends JsonResource
{

    public function toArray($request)
    {
        $customer_id = Customer::where('id' ,  $this->customer_id)->first()['persone_id'] ;
        return  [
            'rating_id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => DB::table('persones')->where('id' , $customer_id)->value('name'),
            'value' => $this->value,
            'notes' => $this->notes,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
}
