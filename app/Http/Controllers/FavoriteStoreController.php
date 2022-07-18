<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\StoreFavoriteStoreRequest;
use App\Http\Resources\BoshraRe\StoresResource;
use App\Models\FavoriteStore;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteStoreController extends BaseController
{

    //عرض مفضله المتاجر للزبون//
    public function Show_Favorite()
    {
        $favorite = DB::table('stores')
            ->join('favorite_stores', function ($join) {
                $join->on('stores.id', '=', 'favorite_stores.store_id')
                    ->where('favorite_stores.customer_id', '=',4/* Auth::id()*/);
            })
            ->get();
        return response(
            $favorite
        );
    }
    public  function  index(){
        $store=Store::all();
        return StoresResource::Collection($store);


    }

    ////////ارجاع مفضلتي
    ///boshra
    public function myFavorite($user_id)
    {

        $favorite = FavoriteStore::select('store_id')->where('customer_id', $user_id)->get();
        if ($favorite)
            return $this->sendResponse($favorite, 'Success');
        else
            return $this->sendErrors([], 'Failed');
    }

    //اضافه لمفضله المتاجر//
    //boshra
    public function Add_Favorite(StoreFavoriteStoreRequest $request )
    {

        $response = FavoriteStore::Create(
            [
                'store_id' => $request->store_id ,
                'customer_id' => $request->customer_id
            ]
            );

        if($response)
            return $this->sendResponse($response, "success");

        return $this->sendErrors([], "failed");


    }


    //حدف مننج من مفضله المتاجر//
    ///boshra
    public function Delete_Favorite($store_id , $cus_id)
    {
        $res = FavoriteStore::where('store_id', $store_id)->where('customer_id' , $cus_id)->delete();
        if ($res)
            return $this->sendResponse($res, "success");
        else
            return $this->sendErrors([], "failed");
    }
}
