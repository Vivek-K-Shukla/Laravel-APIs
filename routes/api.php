<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("data",[dummyAPI::class,'getData']);
Route::get("list/{id?}",[dummyAPI::class,'list']);
Route::post("add",[dummyAPI::class,'add']);
Route::put("update",[dummyAPI::class,'update']);
Route::delete("delete/{id}",[dummyAPI::class,'delete']);
Route::get("search/{name}",[dummyAPI::class,'search']);
Route::post("save",[dummyAPI::class,'testData']);
Route::post("upload",[dummyAPI::class,'upload']);

// Route::apiResource("member",MemberController::class);

//Public Routes:-
Route::post("/register",[UserController::class,"register"]);
Route::post("/login",[UserController::class,"login"]);
Route::post("/send-reset-password-email",[PasswordResetController::class,"send_reset_password_email"]);
Route::post("/reset-password/{token}",[PasswordResetController::class,"reset"]);

//Protected Routes:-
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post("/logout",[UserController::class,"logout"]);
    Route::get("/loggeduser",[UserController::class,"logged_user"]);
    Route::post("/changepassword",[UserController::class,"change_password"]);

});
