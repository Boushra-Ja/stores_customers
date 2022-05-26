<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Persone;
use Dotenv\Validator;

class CustomerController extends Controller
{

    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('faizzoubi10@gmail.com', 'Tutorials Point');
          // ->subject('Laravel Basic Testing Mail');
            $message->from('faizzoubi11@gmail.com','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
//    public function html_email() {
//        $data = array('name'=>"Virat Gandhi");
//        Mail::send('mail', $data, function($message) {
//            $message->to('abc@gmail.com', 'Tutorials Point')->subject
//            ('Laravel HTML Testing Mail');
//            $message->from('xyz@gmail.com','Virat Gandhi');
//        });
//        echo "HTML Email Sent. Check your inbox.";
//    }
//    public function attachment_email() {
//        $data = array('name'=>"Virat Gandhi");
//        Mail::send('mail', $data, function($message) {
//            $message->to('abc@gmail.com', 'Tutorials Point')->subject
//            ('Laravel Testing Mail with Attachment');
//            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//            $message->from('xyz@gmail.com','Virat Gandhi');
//        });
//        echo "Email Sent with attachment. Check your inbox.";
//    }


    function register (Request $request) {

        $valid = $request->validate([
            'name' => 'required ',
            'email' => 'required | unique:users',
            'password' => 'required',
            'code' => 'nullable',
            'image' => 'nullable',


        ]);

        $persone = Persone::create([
            'name' => $valid['name'],
            'email' => $valid['email'],
            'password' =>$valid['password'],

        ]);
        if($request->code!=null)
            $persone->code=$request->code;
        if($request->image!=null)
            $persone->image=$request->image;
        $persone->save();
        $user1 = Customer::create([
            'persone_id'=>$persone->id,

        ]);


        $user1->save();


        $token = $persone->createToken ('ProductsTolken')->plainTextToken;
        return response ()->json([
            'persone_id' => $persone,
            'token'=>$token,
        ]);


    }

    function login(Request $request) {

        $valid = $request->validate([
            'email' => 'required',
            'password' => 'required|min:3|max:100',

        ]);

        $person = Persone::where('email', $valid['email'])->first();
        ///echo $personm;
        if( $valid['password'] == $person->password)
          $password=true;
        if(!$person || !$password) {
            return response ()->json(['message' => 'Login problem']);
        }
        else {
            $token = $person->createToken ('ProductsTolken')->plainTextToken ;
            return  response ()->json([
                'persone_id' => $person,
                'token'=>$token,
            ]);
        }
    }
    function logout(Request $request) {


        $result = $request->user()->token()->revoke();
        if($result){
            $response = response()->json('User logout successfully',200);
        }else{
            $response = response()->json('Something is wrong',400);
        }
        return $response;

    }


    public function change_password(Request$request)
    {


        $validator = Validator:: make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:3|max:100',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()], 422);
        } else {

            $password = Persone::query()->get()->pluck(['password']);
            if ($password[0] == $request->old_password) {
                $usermodel = Persone::find('1');
                if ($usermodel) {
                    $usermodel->password = $request->password;
                    $usermodel->save();
                    return response()->json(['message' => 'Password successfully updated',], 200);
                }
            } else
                return response()->json(['message' => 'no match password with old ',], 422);

        }


        //$user=new User();
        // $ProductModel=User::query()->get(['password']->pluck());
        // dd($request->password);
        //if($request->old_password=='123321')
        //  {// echo  'yes';
//
//            $user_model=new User;
//           if ($user_model::find(auth::id()))
//            {
//                $user_model->password=$request->password;
//                $user_model->save();
//                return response ()->json([$user_model
//                ]);
//            }
//            $user->update(['password'=>Hash :: make($request->password)]);
//                return response()->json(['message'=>'Password successfully updated',],200);
//         }
//        else
//            return response()->json([
//                'message'=>'Old password does not matched',
//            ],400);
//
//
        // }

    }
}
