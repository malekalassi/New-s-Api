<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCommentsResource;
use App\Http\Resources\AuthorPostResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\If_;

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
     * @param Request $request
     * @return UserResource
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email'=>'required',
            'password' => 'required '
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password =Hash::make($request->get('password'));
        $user->save();

        return new UserResource($user);
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
        $user = User::find($id);

        If($request->has('name')){
            $user->name = $request->get('name');
            $user->save();
        }
        if ($request->has('avatar')){
            $user->avatar = $request->get('avatar');
            $user->save();
        }


        return new UserResource($user);
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

    /**
     * @param Request $request
     * @return TokenResource|string
     */

    public function getToken(Request $request){
        $request->validate([
            'email' =>'required' ,
            'password' =>'required'
        ]);

        $credentials = $request->only('email' , 'password');

        if (Auth::attempt($credentials)){
            $user =User::where('email' , $request->get('email'))->first();
            return new TokenResource(['token' =>$user->api_token]);
        }
        return 'not found';
    }
}
