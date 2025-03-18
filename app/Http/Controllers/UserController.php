<?php
namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function UserRegistration(Request $request){
        try{

            //backend email validation , email is exits or not
            $cnt = 0 ;
            $cnt = User::where('email' , '=' , $request->input('email'))->count();

            //if email not exits in the database
            if($cnt == 0 ){
                User::create([
                    'firstName' => $request->input('firstName'),
                    'lastName' => $request->input('lastName'),
                    'email'    => $request->input('email'),
                    'mobile'  => $request->input('mobile'),
                    'password' => $request->input('password')
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Registration Succssfully'
                ],200);

            }else{//if email exits
                return response()->json([
                    'status'=>"Email Already Exist"
                ],500);
            }

        }catch(\Exception $ex) {
            return response()->json([
                "status" => "failed",
                "message" => "User Registration Failed"
            ], 500);
        }
    }


    public function UserLogin(Request $request){

        // Using Eloquent ORM
        $count = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->count();

        if($count > 0){

            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status'=>'success',
                'message' => 'User Login Successfully',
                'token' => $token
            ]);


        }else{
            return response()->json([
                "status" => "failed",
                "message" => "Unauthorized"
            ]);
        }
    }
}
