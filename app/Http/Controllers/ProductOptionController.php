<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\ProductOption;
use App\Http\Requests\StoreProductOptionRequest;
use App\Http\Requests\UpdateProductOptionRequest;

class ProductOptionController extends BaseController
{

    public function index()
    {
        //
    }



    /////اضافة خيارات المنتج
    public function store(StoreProductOptionRequest $request)
    {

        $productOption = ProductOption::Create([
            'order_product_id' => $request->order_product_id,
            'option_values_id' => $request->option_values_id,
        ]);

        if($productOption)
        {
            return $this->sendResponse($productOption , "success") ;
        }
        return $this->sendErrors([] , "error") ;

    }


    public function show(ProductOption $productOption)
    {
        //
    }




    public function update(UpdateProductOptionRequest $request, ProductOption $productOption)
    {
        //ألتعديل لازم على نفس التسجيلة
    }



}
