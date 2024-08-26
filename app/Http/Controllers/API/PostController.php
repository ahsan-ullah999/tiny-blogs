<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();

        return response()->json([
            'message'=>'list of post',
             'post'=>$posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $posts=new Post;
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts ->save();
        return response()->json([
            'message'=>'create a new post',
             'post'=>$posts
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return response()->json([
            'message'=>'single post',
             'post'=>$post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $posts = Post::find($id);
        $posts->update($request->all());
        return response()->json([
            'message'=>'post update successful',
             'post'=>$posts
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return response()->json([
            'message'=>'post delete successful',
             'post'=>$post->delete(),
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
