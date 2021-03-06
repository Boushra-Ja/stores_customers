<?php

namespace App\Http\Resources\BoshraRe;

use App\Models\Collection;
use App\Models\Product;
use App\Models\RatingStore;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'store_id' => $this->id ,
            'shop_name' => $this->name ,
            'num_cell' => $this->num_of_salling ,
            'image' => $this->image ,
          //  'email' => $this->email ,
            'discription' => $this->discription ,
            'facebook' => $this->facebook ,
            'mobile' => $this->mobile ,
            'status' => $this->status ,
            //'created_at' => $this->created_at->format('Y-m-d '),
            //'updated_at' => $this->updated_at->format('Y-m-d '),
            'review' => RatingResource::collection(RatingStore::where('store_id' , $this->id)->get()) ,
            'my_products' => ProductResource::collection(Product::where('id' , Collection::where('store_id' , $this->id)->value('id'))->get())

        ];
    }
}
