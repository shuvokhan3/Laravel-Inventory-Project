<?php
namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{


    //Auth backend
    public function UserRegistration(Request $request){
        try{

            //backend email validation , email is exits or not

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
                    'status'=>"Failed",
                    'message'=> "Email is Already Exist"
                ]);
            }

        }catch(\Exception $ex) {
            return response()->json([
                "status" => "Registration Failed",
                "message" => "User Registration Failed"
            ], 500);
        }
    }
    public function UserLogin(Request $request){

        // Using Eloquent ORM
        $count = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->select('id')->first();

        if($count !== null){
            //JWT token issue for usar login
            //user login-> jwt token issu
            $token = JWTToken::CreateToken($request->input('email'),$count->id);
            return response()->json([
                'status'=>'success',
                'message' => 'User Login Successfully',
                'token'=>$token
            ],200)->cookie('token', $token, 60);


        }else{
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized!"
            ]);
        }
    }
    public  function SendOtpCode(Request $request){

        //catch email from user request
        $email = $request->input('email');
        //generate a otp code
        $otp = mt_rand(100000, 999999);

        //check the email is exits in the database or not
        $count = User::where('email', '=' , $email)
            ->count();

        //if user exits in the database
        if($count > 0){
            // 1 : otp send user email addess
            //send otp to user email address

            try{
                //send mail to user email address
                Mail::to($email)->send(new OTPMail($otp));
            }catch (\Exception $ex){
                return response()->json([
                    "status" => "failed",
                    "message" => "OTP Mail Dose Not Work Properly"
                ]);
            }


            // 2 : otp insert into the database
            //here i update the otp that bydefault set it 0
             User::where('email', '=' ,$email)
                 ->update([
                     'otp' => $otp
                 ]);

             return response()->json([
                 'status'=>'success',
                 'message'=>'OTP Send Successfully'
             ],200);
        }
        else{//return unauthorized
            return response()->json([
                "status" => "failed",
                "message"=> "Unauthorized"
            ]);
        }


    }
    public function verifyOTP(Request $request)
    {
        //catch email and otp
        $email = $request->input('email');
        $otp = $request->input('otp');

        //check the otp send for this email address
        $count = User::where('email', '=' , $email)
            ->where('otp', '=' ,$otp)
            ->count();

        if($count > 0){
            //Update otp on database
            User::where('email', '=', $email)
                ->update(['otp' => '0']);

            //Password reset Token Issue
            $token = JWTToken::CreateTokenForSetPassword($email);
            return response()->json([
                'status'=>'success',
                'message'=>'OTP verifcation  Successfully',
                'verifyOTPtoken' => $token
            ]);
        }

        else{
            return response()->json([
                'status'=>'failed',
                'message' => 'otp is invalid'
            ]);
        }


    }
    public function PasswordReset(Request $request)
    {
        try{
            //Get this email add decoding the JWTToken
            $email = $request->header('email');
            //user set password
            $password = $request->input('password');

            //update password using email that come from JWTToken
            User::where('email', '=', $email)
                ->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successfully'
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 'failed',
                'message' => 'Password Not Reset '
            ]);
        }

    }
    public function UserLogout(){

        return redirect('/')->cookie('token', '',-1);
    }

    //load user profile data automaticaly when user open there profile
    public function getUserProfileData(Request $request)
    {
        $email = $request->header('email');
        $id = $request->header('id');

        $val = User::where('email', '=', $email)
            ->where('id', '=', $id)->first();

        if($val != null){
            return response()->json([
                'status'=> 'success',
                'value' => $val
            ],200);
        }else{
            return response()->json([
                'status'=>'failed',
            ]);
        }
    }

    //profile update
    public function upDateUserProfileData(Request $request)
    {
        //id and email come from token header, that issue for this user when user try to login
        $id = $request->header('id');
        $email = $request->header('email');

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        try{
            //using model i run query for update user database
            User::where('id', '=', $id)
                ->where('email', '=', $email)
                ->first()
                ->update([
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'mobile' => $mobile,
                    'password' => $password
                ]);
            //return a success result if the profile update successfully
            return response()->json([
                'status'=>'success',
                'message'=>'Profile Updated Successfully'
            ],200);
        }catch (\Exception $ex){
            //return an error if profile not update successfully
            return response()->json([
                'status'=>'failed',
                'message'=>'Update Failed'
            ]);
        }
    }
    public function AdminDetails(Request $request){

        try{

            $user_id = $request->header('id');

            $name = User::where('id', $user_id)
                ->get('firstName');
            $email = User::where('id', $user_id)
                ->get('email');
            return response()->json([
                'status'=>'success',
                'name' => $name,
                'email' => $email
            ],200);

        }catch (\Exception $ex){
            return response()->json([
                'status'=>'failed',
                'message'=>'Something Went Wrong'
            ]);
        }
    }
    //page view controller
    public function ViewLogin()
    {
        return view('pages.auth.login-page');
    }
    public function ViewRegister(){
        return view('pages.auth.registration-page');
    }
    public function ResetPassword(){
        return view('pages.auth.reset-pass-page');
    }
    public function SendOTP(){
        return view('pages.auth.send-otp-page');
    }
    public  function vOTP()
    {
        return view('pages.auth.verify-otp-page');
    }
    public function userProfile(){
        return view('pages.dashboard.userProfile-page');
    }


}
