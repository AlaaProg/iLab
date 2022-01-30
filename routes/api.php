<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckUPController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SickController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("login", [AuthController::class , "login"]);

Route::apiResource("news", NewsController::class)->only(["index", "show"]);

Route::middleware('auth:api')->group(function () {

    Route::get('me', [ProfileController::class , "getProfile"]);
    Route::put('me/update', [ProfileController::class , "updateProfile"]);

    Route::prefix("panel")->group(function(){
        Route::middleware('role:admin')->group(function(){
            Route::apiResource("user", UserController::class);
            Route::apiResource("news", NewsController::class);
        });
        Route::middleware(['role:lab,admin'])->group(function(){
            Route::apiResource("user", UserController::class)->only('index');
            Route::apiResource("checkup", CheckUPController::class); 
        });
    });

    Route::get("checkups", [SickController::class, "getCheckups"]);
});


