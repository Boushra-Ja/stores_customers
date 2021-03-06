<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\RatingOrder;
use App\Models\SecondrayClassificationProduct;
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
            'store_id' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('store_id'))->value('id'),
            'store_name' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('store_id'))->value('name'),
            'num_salling_store' => Store::where('id' , Collection::where('id' , $this->collection_id )->value('id'))->value('num_of_salling'),

        ];
    }
}
