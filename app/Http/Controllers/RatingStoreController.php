<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\RatingStore;
use App\Http\Requests\StoreRatingStoreRequest;
use App\Http\Resources\BoshraRe\RatingResource;


class RatingStoreController extends BaseController
{


    ///عرض جميع تقييمات المتاجر
    public function index()
    {
        $rating = RatingStore::all();
        if ($rating) {
            return $this->sendResponse(RatingResource::collection($rating), 'تم ارجاع جميع التقييمات بنجاح');
        } else {
            return $this->sendErrors("خطأ في عرض التقييمات",  ['error' => 'error in display ratings']);
        }
    }



    ////////تقيييم متجر من قبل الزبون
    public function store(StoreRatingStoreRequest $request)
    {
        $input = $request->all();
        $rating = RatingStore::create($input);

        if ($rating) {
            return $this->sendResponse(new RatingResource($rating), 'نجحت عملية التقييم');
        } else {
            return $this->sendErrors('فشل في عملية التقييم', ['error' => 'not rating store']);
        }
    }
}
