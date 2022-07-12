<?php

namespace App\Http\Controllers;

use App\Models\Persone;
use App\Models\Privilladge;
use App\Models\StoreManager;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Token;


class StoreManagerController extends BaseController
{

    /////عرض معلومات صاحب متجر محدد
    public function index($id)
    {
        $storeManager = StoreManager::where('id', '=', $id)->first();
        $persone = Persone::where('id', '=', $storeManager->person_id)->first();
        if ($storeManager) {
            return $this->sendResponse($persone, 'Store Shop successfully');
        } else {
            return $this->sendErrors('failed in Store Shop', ['error' => 'not Store Shop']);

        }
    }

    //////انشاء حساب صاحب متجر
    public static function register(Request $request, $store_id)
    {

        $valid = $request->validate([
            'username' => 'required ',
            'email' => 'required | unique:users',
            'password' => 'required',
        ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $pin = mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 1)]
            . $characters[rand(0, strlen($characters) - 1)];


        $code = str_shuffle($pin);


        $persone = Persone::create([
            'name' => $valid['username'],
            'email' => $valid['email'],
            'password' => $valid['password'],
            'code' => $code,
        ]);


        if ($persone) {
            $token = $persone->createToken('StoreManagerToken')->plainTextToken;
            $persone->save();

            $user1 = StoreManager::create([
                'person_id' => $persone->id,
                'store_id' => $store_id,
            ]);

            $user1->save();

            $privilladge = Privilladge::all();
            if ($privilladge)

                foreach ($privilladge as $option) {
                    PrivilladgeStoreManagerController::store($option->id, $user1->id);
                }

            //   mailcontrol::html_email($persone->name, $code, $persone->email, 'التحقق من البريد الالكتوني');

            return $user1->id;


        }


    }

    public function unique_email(Request $request)
    {
        $person = Persone::where('email', '=', $request->email)->first();
        if ($person) {
            return $this->sendResponse("error", 'The Email already exists');
        } else
            return $this->sendResponse("success", 'The Email is unique');

    }

    public static function update(Request $request)
    {
        if ($request->password)
            Persone::where('id', '=', $request->persone_id)->first()->update([
                'name' => $request->username,
                'email' => $request->email,
                'password' => $request->password

            ]);
        else
            Persone::where('id', '=', $request->persone_id)->first()->update([
                'name' => $request->username,
                'email' => $request->email,
            ]);

        if ($request->helper_name)
            HelperController::store($request);
    }

    public function true_password(Request $request)
    {
        $persone = Persone::where('id', '=', $request->persone_id)->first();
        if ($persone)
            if ($persone->password == $request->old_password)
                return $this->sendResponse("success", 'كلمة السر مطابقة');
            else
                return $this->sendResponse("erorr", 'كلمة السر غير مطابقة');
    }

    ///// تسجيل الدخول كصاحب متجر
    public function login(Request $request)
    {

        $valid = $request->validate([
            'email' => 'required',
            'password' => 'required|min:3|max:100',
        ]);

        $person = Persone::where('email','=', $valid['email'])->first();
        if($person)
        if($person->password == $valid['password']){
            $storManager=StoreManager::where('person_id','=',$person->id)->first();
            $token = $person->createToken('ProductsTolken')->plainTextToken;
            return response()->json([
                'message'=>'success',
                'manager_id' => $storManager->id,
                'store_id' => $storManager->store_id,
            ]);

        }
        else{
            return response()->json([
                'message'=>'erorr',
            ]);
        }
        //$password = Persone::where($valid['password'],'=', $person->password);
//        if (!$person || !$password) {
//            return response()->json(['message' => 'Login problem']);
//        } else {
//            $token = $person->createToken('ProductsTolken')->plainTextToken;
//            return response()->json([
//                'manager_id' => $storManager->id,
//                'store_id' => $storManager->store_id,
//            ]);
        //}
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
