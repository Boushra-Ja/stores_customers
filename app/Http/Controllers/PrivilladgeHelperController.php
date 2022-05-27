<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\Privilladge;

class PrivilladgeHelperController extends Controller
{
    public Static function store($privilladge_id,$helper_id)
    {
        $privilladge=Privilladge::find($privilladge_id);
        $helper=Helper::find($helper_id);

        $response=$privilladge->helper()->attach($helper);
        return response()->json($response,200);
    }
}
