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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
