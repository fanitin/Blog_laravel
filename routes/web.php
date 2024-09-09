<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::namespace("App\Http\Controllers\Main")->name("main.")->group(function () {
    Route::get("/", "IndexController")->name("index");
});


Route::namespace("App\Http\Controllers\Admin")->prefix("admin")->name("admin.")->group( function() {
    Route::namespace("Main")->group(function () {
        Route::get("/", "IndexController")->name("index");
    });


    Route::namespace("Post")->prefix("post")->name("post.")->group( function() {
        Route::get("/", "IndexController")->name("index");
        Route::get("/create", "CreateController")->name("create");
        Route::post("/", "StoreController")->name("store");
        Route::get("/{post}", "ShowController")->name("show");
        Route::get("/{post}/edit", "EditController")->name("edit");
        Route::patch("/{post}", "UpdateController")->name("update");
        Route::delete("/{post}", "DeleteController")->name("delete");
    });


    Route::namespace("Category")->prefix("category")->name("category.")->group( function() {
        Route::get("/", "IndexController")->name("index");
        Route::get("/create", "CreateController")->name("create");
        Route::post("/", "StoreController")->name("store");
        Route::get("/{category}", "ShowController")->name("show");
        Route::get("/{category}/edit", "EditController")->name("edit");
        Route::patch("/{category}", "UpdateController")->name("update");
        Route::delete("/{category}", "DeleteController")->name("delete");
    });


    Route::namespace("Tag")->prefix("tag")->name("tag.")->group( function() {
        Route::get("/", "IndexController")->name("index");
        Route::get("/create", "CreateController")->name("create");
        Route::post("/", "StoreController")->name("store");
        Route::get("/{tag}", "ShowController")->name("show");
        Route::get("/{tag}/edit", "EditController")->name("edit");
        Route::patch("/{tag}", "UpdateController")->name("update");
        Route::delete("/{tag}", "DeleteController")->name("delete");
    });
});