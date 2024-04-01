<?php

use App\Http\Controllers\API\BargainController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(BargainController::class)->group(function(){
    Route::get('search', 'search');
});

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::controller(BargainController::class)->group(function(){
//         Route::get('search', 'search');
//     });
// });


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
