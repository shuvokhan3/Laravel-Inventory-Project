<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::post('/UserRegistration',[UserController::class,'UserRegistration']);
Route::post('/userLogin',[UserController::class,'UserLogin']);
