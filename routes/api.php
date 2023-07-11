<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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

Route::middleware('auth:api')->group(function () {
    //for product
    Route::get("product/{id?}", [ProductController::class, 'get_user_product']);
    Route::get("all-product", [ProductController::class, 'get_all_product']);

    //for cart
    Route::post("add-to-cart", [CartController::class, 'add_to_cart']);
    //show cart by userId
    Route::get("carts/{id?}", [UserController::class, 'show_cart']);
    Route::post("add-quantity/{id?}", [CartController::class, 'add_quantity']);
    Route::post("remove-quantity/{id?}", [CartController::class, 'remove_quantity']);
    Route::get("delete-cart/{id?}", [CartController::class, 'delete_cart']);

    //category
    Route::get("search/{name?}", [CategoryController::class, 'search_product_byCategory']);

    //address
    Route::post("add-address", [AddressController::class, 'add_address']);
    Route::post("edit-address/{id?}", [AddressController::class, 'edit_address']);
    Route::get("delete-address/{id?}", [AddressController::class, 'delete_address']);
    //show address by userId
    Route::get("address/{id?}", [UserController::class, 'show_address']);

    //for order
    Route::post("create-order", [OrderController::class, 'create_order']);
    Route::get("delete-order", [OrderController::class, 'delete_order']);
    //show orders by userId
    Route::get("show-order/{id?}", [UserController::class, 'show_orders']);
});

Route::post("register", [UserController::class, 'create_User']);
Route::post("login", [UserController::class, 'login']);
Route::post("forgotpassword", [UserController::class, 'forgot_password']);
