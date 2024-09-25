<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Auth::routes();               # ['verify' => true] to verify email

Route::namespace("App\Http\Controllers\Main")->name("main.")->group(function () {
    Route::get("/", "IndexController")->name("index");
});

Route::namespace("App\Http\Controllers\Category")->name("category.")->prefix('categories')->group(function () {
    Route::get("/", "IndexController")->name("index");

    Route::namespace("Post")->prefix("{category}/posts")->name("post.")->group(function () {
        Route::get("/", "IndexController")->name("index");
    });
});

Route::namespace("App\Http\Controllers\Post")->name("post.")->prefix('post')->group(function () {
    Route::get("/", "IndexController")->name("index");
    Route::get("/{post}", "ShowController")->name("show");

    Route::namespace("Comment")->prefix("{post}/comments")->name("comment.")->group(function () {
        Route::post("/", "StoreController")->name("store");
    });

    Route::namespace("Like")->prefix("{post}/likes")->name("like.")->group(function () {
        Route::post("/", "StoreController")->name("store");
    });
});


Route::middleware(['auth'])->namespace("App\Http\Controllers\Personal")->prefix("personal")->name("personal.")->group( function() {
    Route::namespace("Main")->group(function () {
        Route::get("/", "IndexController")->name("index");
    });
    Route::namespace("Liked")->prefix("liked")->name("liked.")->group(function () {
        Route::get("/", "IndexController")->name("index");
        Route::delete("/{post}", "DeleteController")->name("delete");
    });
    Route::namespace("Comment")->prefix("comment")->name("comment.")->group(function () {
        Route::get("/", "IndexController")->name("index");
        Route::delete("/{post}", "DeleteController")->name("delete");
        Route::get("/{comment}/edit", "EditController")->name("edit");
        Route::patch("/{comment}", "UpdateController")->name("update");
    });
});


#Route::middleware(['auth', AdminMiddleware::class, 'verified']) to verify email
Route::middleware(['auth', AdminMiddleware::class])->namespace("App\Http\Controllers\Admin")->prefix("admin")->name("admin.")->group( function() {
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


    Route::namespace("User")->prefix("user")->name("user.")->group( function() {
        Route::get("/", "IndexController")->name("index");
        Route::get("/create", "CreateController")->name("create");
        Route::post("/", "StoreController")->name("store");
        Route::get("/{user}", "ShowController")->name("show");
        Route::get("/{user}/edit", "EditController")->name("edit");
        Route::patch("/{user}", "UpdateController")->name("update");
        Route::delete("/{user}", "DeleteController")->name("delete");
    });
});