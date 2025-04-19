<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


//registration route
Route::post('/userRegistration',[UserController::class,'UserRegistration']);
//login route
Route::post('/userLogin',[UserController::class,'UserLogin']);
//user logout
Route::get('/logout', [UserController::class, 'UserLogout'])->middleware(TokenVerificationMiddleware::class);
//otp route
Route::post('/sendOtpCode',[UserController::class,'SendOtpCode']);
Route::post('/verifyOTP',[UserController::class,'verifyOTP']);
//Token Verify
Route::post('/passwordReset',[UserController::class,'PasswordReset'])
->middleware(TokenVerificationMiddleware::class);
//auto complete user profile data on the user profile form
Route::get('/getUserProfileData',[UserController::class, 'getUserProfileData'])->middleware(TokenVerificationMiddleware::class);
Route::post('/upDateUserProfileData',[UserController::class, 'upDateUserProfileData'])->middleware(TokenVerificationMiddleware::class);


//category route

//category page route
Route::get('/categoryPage',[CategoryController::class,'categoryView'])->middleware(TokenVerificationMiddleware::class);
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

//customer route
//customer page route
Route::get('/customerPage',[CustomerController::class,'viewCustomer'])->middleware(TokenVerificationMiddleware::class);
//customer backend route
//customer create
Route::post('/createCustomer',[CustomerController::class,'CustomerStore'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customerList',[CustomerController::class, 'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customerDelete',[CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customerById',[CustomerController::class, 'CustomerById'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customerUpdate',[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);


//page route
Route::get('/login',[UserController::class,'ViewLogin']);
Route::get('/userRegistration',[UserController::class,'ViewRegister']);
Route::get('/resetpassword',[UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/sendOtp',[UserController::class,'SendOTP']);
Route::get('/verifyOTP',[UserController::class, 'vOTP']);
Route::get('/dashboard',[UserController::class,'Dashboard'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userProfile',[UserController::class, 'userProfile'])->middleware(TokenVerificationMiddleware::class);
