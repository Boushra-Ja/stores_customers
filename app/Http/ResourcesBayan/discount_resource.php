<?php

namespace App\Http\ResourcesBayan;

use App\Models\DiscountProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class discount_resource extends JsonResource
{

    public function toArray($request)
    {
        $product=DiscountProduct::where('discounts_id', '=', $this->id)->first();
        return [
            'id' => $product->id,
            'discounts_id'=>$this->id,
            'type' => $this->type,
            'value' => $this->value,
            'start_date' => $this->start_date,
            'end_date' =>  $this->end_date,
            'title'=>$product->title,
            'apply_to'=>$product->apply_to

        ];
    }
}
