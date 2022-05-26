<?php

namespace App\Http\Controllers;

use App\Models\Persone;
use App\Models\StoreManager;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Token;


class StoreManagerController extends BaseController
{

    /////عرض معلومات صاحب متجر محدد
    public function index(Request $request)
    {
        $storeManager = StoreManager::find($request->id);
        if ($storeManager) {
            return $this->sendResponse($storeManager, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }
    }

    //////انشاء حساب صاحب متجر
    public function register(Request $request)
    {

        $valid = $request->validate([
            'name' => 'required ',
            'email' => 'required | unique:users',
            'password' => 'required',
            'image'

        ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $pin = mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)];


        $code = str_shuffle($pin);



        $persone = Persone::create([
            'name' => $valid['name'],
            'email' => $valid['email'],
            'password' => $valid['password'],
            'code' => $code,
        ]);


        if ($persone) {
            $token = $persone->createToken('StoreManagerToken')->plainTextToken;
            $persone->save();

//            $persone->update(['remember_token',$token]);
//            $persone->save();


            $user1 = StoreManager::create([
                'person_id' => $persone->id,
                'store_id' => $request->store_id,
            ]);

            $user1->save();

            mailcontrol::html_email($persone->name, $code, $persone->email, 'التحقق من البريد الالكتوني');

            return response ()->json([
                'persone_id' => $persone,
                'token'=>$token,
            ]);
//6|EWMBFY1aCJwpIpNaUQ8WsxtWPH8jLajnSSxOPSqb
            // return $this->sendResponse($persone, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }


    }


    ///// تسجيل الدخول كصاحب متجر
    public function login(Request $request)
    {

        $valid = $request->validate([
            'email' => 'required',
            'password' => 'required|min:3|max:100',
        ]);

        $person = Persone::where('email', $valid['email'])->first();
        $password = Persone::where($valid['password'], $person->password);
        if (!$person || !$password) {
            return response()->json(['message' => 'Login problem']);
        } else {
            $token = $person->createToken('ProductsTolken')->plainTextToken;
            return response()->json([
                'persone_id' => $person,
                'token' => $token,
            ]);
        }
    }


    ////////التحقق من البريد
    public function verify_email(Request $request)
    {
        $persone = Persone::where('email', '=', $request->persone)->first();
        if ($persone) {
            if (strcmp($persone->code, $request->code) == 0)
                echo "ssssssssss";
            else
                echo "fffffffffff";
        } else
            echo "dose not exists";


    }


    public function forget_password(Request $request)
    {
        $persone = Persone::where('email', '=', $request->persone)->first();
        if ($persone) {

            mailcontrol::html_email_password($persone->name, $persone->email, 'اعادة تعين كلمة المرور', $persone->id);


        } else
            echo "dose not exists";

    }


    public function reset_password(int $id, string $new_password)
    {
        $persone = Persone::find($id)->update(['password', $new_password]);

    }


}
