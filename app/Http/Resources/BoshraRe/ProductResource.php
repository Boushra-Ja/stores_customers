<?php

namespace App\Http\Resources\BoshraRe;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'product_id' => $this->id ,
            'product_name' => $this->name ,
            'image' => $this->image ,
            'selling_price' => $this->selling_price,
           // 'num_cell' => $this->num_of_salling ,
            //'prepration_time' => $this->email ,
            //'party' => $this->password,
            //'discription' => $this->discription ,
           // 'age' => $this->facebook ,
           // 'selling_price' => $this->mobile ,
           // 'cost_price' => $this->status ,
           // 'created_at' => $this->created_at->format('Y-m-d '),
           // 'updated_at' => $this->updated_at->format('Y-m-d '),
          //  'return_or_replace' => $this->return_or_replace ,
          //  'discount_products_id' => $this->discount_products_id

        ];
    }
}
