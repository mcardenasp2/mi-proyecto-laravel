<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 'Hola mundo Laravel';
        // return response()->json([
        //     'title'=>'Hola mundo',
        //     'contenido'=>'con'
        // ]);
        $posts= Post::
        join('post_images','post_images.post_id','=','posts.id')->
        join('categories','categories.id','=','posts.category_id')->
        select('posts.*','categories.title as category', 'post_images.image')->
        orderBy('posts.created_at','desc')->paginate(10);
        // dd($posts);F
        // $posts=Post::all();
        // return response()->json($posts,200);
        return $this->successResponse($posts);
    }

  

  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->image;
        $post->category;
        // return response()->json(array("data"=>$post,"code"=>200,"msj"=>""));
        return $this->successResponse($post);
    }
    public function url_clean(String $url_clean)
    {
        $post=Post::where('url_clean',$url_clean)->firstOrFail();
        $post->image;
        $post->category;
        // return response()->json(array("data"=>$post,"code"=>200,"msj"=>""));
        return $this->successResponse($post);
    }

    public function category(Category $category)
    {
        // $category->image;
        // $post->category;
        // return response()->json(array("data"=>$post,"code"=>200,"msj"=>""));
        // sin relacion
        // return $this->successResponse(["posts"=>$category->post()->paginate(10),"category"=>$category]);
    
        $posts= Post::
        join('post_images','post_images.post_id','=','posts.id')->
        join('categories','categories.id','=','posts.category_id')->
        select('posts.*','categories.title as category', 'post_images.image')->
        orderBy('posts.created_at','desc')->
        where('categories.id',$category->id)->
        paginate(10);
        return $this->successResponse(["posts"=>$posts,"category"=>$category]);

    }

    

  

}
