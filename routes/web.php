<?php

use App\Http\Controllers\CategoryController;
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
Route::post('/upDateUserProfileData',[UserController::class, 'upDateUserProfileData'])->middleware(TokenVerificationMiddleware::class);

//user logout
Route::get('/logout', [UserController::class, 'UserLogout'])->middleware(TokenVerificationMiddleware::class);

//category backend route
//category create
Route::post('/createCategory',[CategoryController::class,'CategoryStore'])->middleware(TokenVerificationMiddleware::class);
//category display
Route::get('/categoryList',[CategoryController::class, 'CategoryList'])->middleware(TokenVerificationMiddleware::class);
//Delete category
Route::post('/categoryDelete',[CategoryController::class,'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
//show category
Route::get('/ShowCategoryUpdateFormData',[CategoryController::class, 'ShowCategoryUpdateFormData'])->middleware(TokenVerificationMiddleware::class);
//update Category
Route::post('/categoryUpdate',[CategoryController::class,'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);


//page route
Route::get('/login',[UserController::class,'ViewLogin']);
Route::get('/userRegistration',[UserController::class,'ViewRegister']);
Route::get('/resetpassword',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/sendOtp',[UserController::class,'SendOTP']);
Route::get('/verifyOTP',[UserController::class, 'vOTP']);
Route::get('/dashboard',[UserController::class,'Dashboard'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userProfile',[UserController::class, 'userProfile'])->middleware(TokenVerificationMiddleware::class);

//category page route
Route::get('/categoryPage',[CategoryController::class,'categoryView'])->middleware(TokenVerificationMiddleware::class);
