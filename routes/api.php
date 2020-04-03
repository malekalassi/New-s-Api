<?php

use Illuminate\Http\Request;

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
/**
 * @User related
 */
Route::get('/authors', 'Api\\UserController@index');
Route::get('/author/{id}', 'Api\\UserController@show');
Route::get('/posts/author/{id}' , 'Api\\UserController@posts');
Route::get('/comments/author/{id}' , 'Api\\UserController@comments');
Route::get('/comments/post/{id}' ,'Api\\CommentController@show');


/**
 * @End user
 */

Route::post('/register' , 'Api\UserController@store');
Route::post('/token' , 'Api\UserController@getToken');

/**
 * @post Related
 *
 */
Route::get('/categories' , 'Api\\CategoryController@index');
Route::get('/posts/category/{id}' , 'Api\\CategoryController@posts');
Route::get('/posts' , 'Api\\PostController@index');
Route::get('/post/{id}' , 'Api\\PostController@show');
/**
 * End Post
 *
 */
Route::middleware('auth:api')->group(function (){
   Route::post('update-user/{id}' , 'Api\\UserController@update');
   Route::post('post' , 'Api\\PostController@store');
   Route::post('post/{id}' , 'Api\\PostController@update');
   Route::post('post/{id}' , 'Api\\PostController@update');
   Route::delete('post/{id}' , 'Api\\PostController@destroy');
   Route::POST('comments/posts/{id}' , 'Api\\CommentController@store');

});
