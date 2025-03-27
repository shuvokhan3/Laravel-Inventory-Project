<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

//web api route
//registration route
Route::post('/userRegistration',[UserController::class,'UserRegistration']);
//login route
Route::post('/userLogin',[UserController::class,'UserLogin']);
//otp route
Route::post('/sendOtpCode',[UserController::class,'SendOtpCode']);
Route::post('/verifyOTP',[UserController::class,'verifyOTP']);
//Token Verify
Route::post('/passwordReset',[UserController::class,'PasswordReset'])
->middleware(TokenVerificationMiddleware::class);
//auto complete user profile data on the user profile form
Route::get('/getUserProfileData',[UserController::class, 'getUserProfileData'])->middleware(TokenVerificationMiddleware::class);


//user logout
Route::get('/logout', [UserController::class, 'UserLogout'])->middleware(TokenVerificationMiddleware::class);

//page route
Route::get('/login',[UserController::class,'ViewLogin']);
Route::get('/userRegistration',[UserController::class,'ViewRegister']);
Route::get('/resetpassword',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/sendOtp',[UserController::class,'SendOTP']);
Route::get('/verifyOTP',[UserController::class, 'vOTP']);
Route::get('/dashboard',[UserController::class,'Dashboard'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userProfile',[UserController::class, 'userProfile'])->middleware(TokenVerificationMiddleware::class);

