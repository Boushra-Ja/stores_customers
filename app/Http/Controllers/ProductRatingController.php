<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\ProductRating;
use App\Http\Requests\StoreProductRatingRequest;
use App\Http\Resources\BoshraRe\RatingResource;

class ProductRatingController extends BaseController
{
    //عرض جميع تقييمات المنتجات
    public function index()
    {
        $rating = ProductRating::all();
        if ($rating) {
            return  $this->sendResponse(RatingResource::collection($rating), 'تم ارجاع جميع التقييمات بنجاح');
        } else {
            return $this->sendErrors("خطأ في عرض التقييمات",  ['error' => 'error in display ratings']);
        }
    }
    /////تقييم منتج من قبل الزبون
    public function store(StoreProductRatingRequest $request)
    {
        $input = $request->all();
        $rating = ProductRating::create($input);

        if ($rating) {
            return $this->sendResponse(new RatingResource($rating), 'نجحت عملية تقييم المنتج');
        } else {
            return $this->sendErrors('فشل في عملية التقييم', ['error' => 'not rating store']);
        }
    }
}
