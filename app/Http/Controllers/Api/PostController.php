<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostsResource(Post::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required' ,
            'content' => 'required' ,
            'category_id'=>'required'
        ]);

        $user = $request->user() ;

        $post =new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->written_date = Carbon::now()->format('Y-m-d H:i:s');
        $post->voted_up = 0;
        $post->voted_down = 0;
        $post->user_id = $user->id;
        $post->category_id = $request->get('category_id');

        //Handle the featured image
//        if ($request->has('featured_image')){
//            $featuredImage = $request->file('featured_image');
////           $featuredImage = request('featured_image')->store('image' , 'public');
//
//            $filename = time().$featuredImage->getClientOriginalName();
//            $path = public_path("images/{$filename}");
//
//            Storage::disk('local')->putFileAs(
//                $path ,
//                $featuredImage ,
//                $filename
//            );
//            $post->featured_image = $path ;
//        }

        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return new PostResource($post);
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
        $user =$request->user();
        $post = Post::find($id) ;

        if ($request->has('title')){
            $post->title = $request->get('title');
        }

        if ($request->has('content')){
            $post->content = $request->get('content');
        }

        if ($request->has('category_id')){
            $post->category_id = $request->get('category_id');
        }




        //Handle the featured image
//        if ($request->has('featured_image')){
//            $featuredImage = $request->file('featured_image');
////           $featuredImage = request('featured_image')->store('image' , 'public');
//
//            $filename = time().$featuredImage->getClientOriginalName();
//            $path = public_path("images/{$filename}");
//
//            Storage::disk('local')->putFileAs(
//                $path ,
//                $featuredImage ,
//                $filename
//            );
//            $post->featured_image = $path ;
//        }

        $post->save();

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
        $post->delete();


        return new PostResource($post);
    }
}
