<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Collection;
use App\Models\RatingOrder;
use App\Models\Store;
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
            'store_id' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('id'))->value('id'),
            'store_name' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('id'))->value('name'),
            'num_salling_store' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('id'))->value('num_of_salling'),
            'review' => RatingResource::collection(RatingOrder::where('product_id' , $this->id)->get()) ,


        ];
    }
}
