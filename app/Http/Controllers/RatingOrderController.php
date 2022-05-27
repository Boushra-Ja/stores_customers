<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\RatingOrder;
use App\Http\Requests\StoreRatingOrderRequest;
use App\Http\Requests\UpdateRatingOrderRequest;
use App\Http\Resources\BoshraRe\RatingResource;

class RatingOrderController extends BaseController
{

    //عرض جميع تقييمات المنتجات
    public function index()
    {
        $rating = RatingOrder::all() ;
        if($rating)
        {
            $this->sendResponse(RatingResource::collection($rating) , 'تم ارجاع جميع التقييمات بنجاح') ;
        }
        else{
            $this->sendErrors("خطأ في عرض التقييمات" ,  ['error' => 'error in display ratings']) ;
        }
    }

   /////تقييم منتج من قبل الزبون
    public function store(StoreRatingOrderRequest $request)
    {
        $input = $request->all() ;
        $rating = RatingOrder::create($input) ;

        if ($rating) {
            return $this->sendResponse(new RatingResource($rating), 'نجحت عملية تقييم المنتج');
        } else {
            return $this->sendErrors('فشل في عملية التقييم', ['error' => 'not rating store']);
        }
    }



    public function update(UpdateRatingOrderRequest $request, RatingOrder $ratingOrder)
    {
        //
    }


}
