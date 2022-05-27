<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Privilladge;
use App\Models\StoreManager;

class PrivilladgeStoreManagerController extends BaseController
{
    public Static function store($privilladge_id,$storeManager_id)
    {
        $privilladge=Privilladge::find($privilladge_id);
        $storeManager=StoreManager::find($storeManager_id);

        $response=$privilladge->storeManager()->attach($storeManager);
        return response()->json($response,200);
    }
}
