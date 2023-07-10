<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function(){
    //for product
    Route::get("posts/{id?}",[ProductController::class, 'get_user_product']);
    Route::get("all-posts",[ProductController::class, 'get_all_product']);

    //for cart
    Route::post("add-to-cart",[CartController::class, 'add_to_cart']);
    Route::get("carts/{id?}",[UserController::class, 'show_cart']);

});

Route::post("register",[UserController::class, 'create_User']);
Route::post("login",[UserController::class, 'login']);
Route::post("forgotpassword",[UserController::class,'forgot_password']);
