<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
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
    public function myFavorite($user_id)
    {

        $favorite = FavoriteStore::select('store_id')->where('customer_id', $user_id)->get();
        if ($favorite)
            return $this->sendResponse($favorite, 'Success');
        else
            return $this->sendErrors([], 'Failed');
    }
    //اضافه لمفضله المتاجر//
    public function Add_Favorite($id)
    {

        $store = Store::find($id);
        $customer = auth::id();
        $response = $store->favourits()->attach($customer);
        return $this->sendResponse($response, "success");
    }


    //حدف مننج من مفضله المتاجر//
    public function Delete_Favorite($store_id)
    {
        $res = FavoriteStore::where('store_id', $store_id)->delete();
        if ($res)
            return $this->sendResponse($res, "success");
        else
            return $this->sendErrors([], "failed");
    }
}
