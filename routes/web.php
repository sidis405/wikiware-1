<?php

Route::get('/', 'PostsController@index')->name('posts.index');
Route::resource('posts', 'PostsController')->except('index');


Route::get('categories', 'CategoriesController@index')->name('categories.index');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController')->name('tags.show');


Route::get('posts/{post}/attachment', 'PostsAttachmentController')->name('posts.attachment');


// middleware - admin
// prefix - admin

Route::middleware('admin')->prefix('admin')->group(function () {
    CRUD::resource('categories', 'Admin\CategoryCrudController');
    CRUD::resource('tags', 'Admin\TagCrudController');
    CRUD::resource('posts', 'Admin\PostCrudController');
});



// Route::resource('videos', 'VideosController')->except('index');

// Route::get('posts/create', 'PostsController@create')->name('posts.create');
// Route::get('posts/{post}', 'PostsController@show')->name('posts.show');
// Route::post('posts', 'PostsController@store')->name('posts.store');
// Route::get('posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
// Route::patch('posts/{post}', 'PostsController@update')->name('posts.update');
// Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');

// /posts
// GET, POST, PUT|PATCH, DELETE, OPTIONS

// REST
// index    - GET        - /posts             PostsController@index - posts.index - Listato di posts
// show     - GET        - /posts/{post}      PostsController@show - posts.show - Singolo post
// create   - GET        - /posts/create      PostsController@create - posts.create - Form crazione nuovo post
// store    - POST       - /posts             PostsController@store - posts.store - Persiste nuovo post
// edit     - GET        - /posts/{post}/edit PostsController@edit - posts.edit - Form modifica post esistente


// update   - PUT|PATCH  - /posts/{post}      PostsController@update - posts.update - Aggiorna post esistente
// destroy  - DELETE     - /posts/{post}      PostsController@destroy - posts.destroy - Cancella post esistente

Auth::routes();
