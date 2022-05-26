<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Privilladge;
use App\Models\StoreManager;
use Illuminate\Http\Request;

class PrivilladgeStoreManagerController extends BaseController
{
    public function store(Request $request)
    {
        $privilladge=Privilladge::find($request->privilladge_id);
        $storeManager=StoreManager::find($request->storeManager_id);

        $response=$privilladge->storeManager()->attach($storeManager);
        return response()->json($response,200);
    }
}
