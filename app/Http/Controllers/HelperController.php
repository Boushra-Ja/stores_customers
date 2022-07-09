<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\Privilladge;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public Static function store(Request $request,){


        $request->validate([
            'helper_name' => 'required',
            'helper_email' => 'required',
            'store_manager_id' => 'required',
        ]);

        $helper = Helper::create([
            'name'=>$request->helper_name,
            'email'=>$request->helper_email,
            'store_manager_id'=>$request->store_manager_id
        ]);

        if($helper){
            foreach($request->privilladge as $value){
                $v=Privilladge::where('name','=',$value)->first();
                PrivilladgeHelperController::store($v->id, $helper->id);
            }

          //  mailcontrol::html_email($helper->name, 323, $helper->email, 'دعوة لادارة متجر');

        }

    }

}
