<?php

namespace App\Http\ResourcesBat;

use App\Http\Resources\BoshraRe\RatingResource;
use App\Models\Collection;
use App\Models\Discount;
use App\Models\DiscountProduct;
use App\Models\ProductRating;
use App\Models\RatingStore;
use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingProB extends JsonResource
{

    public function toArray($request)
    {
        return  [
         'id' =>$this->id,

        'title' =>$this->title ,
        'apply_to' => $this->apply_to ,
        'created_at' => $this->created_at ,
        'updated_at' => $this->updated_at ,
        'discounts_id' => $this->discounts_id ,
        'image' => $this->image ,
        'discription' => $this->discription ,
        'gift' => $this->gift ,
        'name' => $this->name ,
        'prepration_time' => $this->prepration_time ,
        'party' => $this->party ,
        'age' => $this->age ,
        'selling_price' =>$this->selling_price ,
        'cost_price' => $this->cost_price ,
        'number_of_sales' => $this->number_of_sales ,
        'return_or_replace' => $this->return_or_replace ,
        'collection_id' => $this->collection_id ,
        'discount_products_id' =>$this->discount_products_id ,
        'rating' => RatingResource::collection(ProductRating::where('product_id', $this->id)->get()),


        ];
    }
}
