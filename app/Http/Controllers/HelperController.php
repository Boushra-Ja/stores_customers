<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public Static function store(Request $request){


        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'store_manager_id' => 'required',
        ]);


        $input = $request->all();
        $helper = Helper::create($input);

        if($helper){
            foreach($request->privilladge as $value){
                PrivilladgeHelperController::store($value, $helper->id);
            }

            mailcontrol::html_email($helper->name, 323, $helper->email, 'دعوة لادارة متجر');

        }

    }

}
