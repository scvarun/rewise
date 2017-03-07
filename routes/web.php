<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/settings', 'HomeController@getSettingsPage');
Route::post('/settings','HomeController@setSchedule');
Route::delete('/remove/schedule/{id}','HomeController@deleteSchedule');
Route::get('/posts','PostController@index');
Route::get('/posts/add', 'PostController@addPostPage');
Route::post('/posts/add','PostController@addPost');
Route::put('/posts/{post}/edit','PostController@saveEditPostPage');
Route::get('/posts/{post}/edit','PostController@getEditPostPage');
Route::delete('/remove/post/{id}','PostController@deletePost');
Route::get('/posts/{post}', 'PostController@getPost')->name('singlePost');
Route::get('/posts/{post}/addComment', 'CommentsController@addCommentPage');
Route::post('/posts/{post}/addComment', 'CommentsController@addComment');
Route::get('/posts/{post}/editComment/{comment}','CommentsController@editCommentPage');
Route::put('/posts/{post}/editComment/{comment}','CommentsController@editComment');
Route::get('/posts/{post}/deleteComment/{comment}','CommentsController@deleteComment');
