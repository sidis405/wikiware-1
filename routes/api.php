<?php


Route::as('api.')->group(function () {
    Route::post('login', 'Api\LoginController')->name('login');

    Route::middleware('jwt.auth')->group(function () {
        Route::resource('posts', 'Api\PostsController')->except('create', 'edit');
    });
});
