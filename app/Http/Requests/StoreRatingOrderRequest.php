<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingOrderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'notes' => 'required' ,
            'value' => 'required | max:3'  ,
            'customer_id' => 'required | exists:customers,persone_id' ,
            'product_id' => 'required | exists:products,id'
        ];
    }
}
