<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCommentsResource;
use App\Http\Resources\AuthorPostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::paginate();
        return new UsersResource($users) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {
        $user = User::find($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return AuthorPostResource
     * Return all posts for the specified author
     */

    public function posts($id){

        $user =User::find($id);
        $posts = $user->posts()->paginate(env('POSTS_PER_PAGE'));
//        dd($posts);
        return new AuthorPostResource($posts);
    }

    /**
     * @param $id
     * @return AuthorCommentsResource
     * @return All Comments for the User
     */
    public function comments($id){
        $user=User::find($id);
        $comments = $user->comments()->paginate(env('COMMENTS_PER_PAGE'));
        return new AuthorCommentsResource($comments);
    }
}
