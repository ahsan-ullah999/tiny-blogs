<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostsListResource;
use App\Http\Resources\Post\PostsShowResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PostController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return[
            new Middleware('auth:sanctum',except:['index','show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostsListResource::collection(Post::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title'=>'required|max:255',
            'description'=>'required'
        ]);
        $posts=$request->user()->post()->create($validation);

        return $posts;



    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return PostsShowResource::make($post);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $posts)
    {

        $posts = Post::find($posts);
        $posts->update($request->all());
        return response()->json([
            'message'=>'post update successful',
             'post'=>$posts
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {

        return response()->json([
            'message'=>'post delete successful',
             'post'=>$posts->delete(),
        ], 200);
    }

               /**
     * search the specified resource from storage.
     * @param str $title
     * @return \Illuminate\Http\Response
     *
     */

     public function search($title)
     {
        return Post::where('title', 'like', '%'.$title.'%')->get();
     }
}
