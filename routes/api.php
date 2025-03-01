<?php

use App\Http\Controllers\BrandsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers;
use App\Http\Controllers\CategoriesController;

//?it's all done -_-
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(
    [
        "middleware" => "api",
        "prefix" => "auth"
    ],
    function ($router) {
        Route::post('register', [AuthController::class, 'register'])->name("register");
        Route::post('login', [AuthController::class, 'login'])->name("login");
//        Route::post('refresh', [AuthController::class, 'refresh'])->name("refresh");
        Route::post('logout', [AuthController::class, 'logout'])->name("logout");
    }
);

//?it's all done -_-
Route::group( ["prefix" => "brand"], function ($router)
{
    Route::controller(BrandsController::class)->group(
        function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::post("create", "store");
            Route::put("update/{id}", "update");
            Route::delete("delete/{id}", "destroy");
        }
    );
});

//? it's all done -_-
Route::group( ["prefix" => "category"], function ($router)
{
    Route::controller(CategoriesController::class)->group(
        function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::post("create", "store");
            Route::put("update/{id}", "update");
            Route::delete("delete/{id}", "destroy");
        });
});
 // it's all done -_-
Route::group( ["prefix" => "location"], function ($router)
{
    Route::controller(Controllers\LocationController::class)->group(
        function () {
            Route::get("index", "index");
            Route::get("show/{id}", "show");
            Route::post("create", "store"); // can't authorize the user with Auth::id()
            Route::put("update/{id}", "update");
            Route::delete("delete/{id}", "destroy");
        }
    );
});
//! it's all done -_-
Route::group( ["prefix" => "product"], function ($router)
{
    Route::controller(Controllers\ProductController::class)->group(
        function () {
            Route::get("index", "index")->middleware("is_admin");
            Route::get("show/{id}", "show");
            Route::post("create", "store");
            Route::put("update/{id}", "update");
            Route::delete("delete/{id}", "destroy");
        }
    );
});

//! under test
Route::group(["prefix"=>"order"] ,function($router)
{
    Route::controller(Controllers\OrderController::class)->group(function ()
    {
        Route::get("index", "index");
        Route::get("show/{id}", "show");
        Route::post("create", "store");
        Route::get("get_order_item/{id}", "get_order_item");
        Route::get("get_user_orders/{id}", "get_user_orders");
        Route::post("change_order_status/{id}", "change_order_status");
    });
});
