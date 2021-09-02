<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\CustomUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCommentPostComment;
use App\Http\Requests\UpdatePostCommentPut;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','rol.admin']);
    }
    public function index()
    {

        // $postComments=PostComment::orderBy('created_at','desc')->get();
        $postComments=PostComment::orderBy('created_at','desc')->paginate(10);
        // dd($postComments);
        // dd($postComments[0]->user);
        // dd($postComments);
        return view('dashboard.post-comment.index',['postComments'=>$postComments]);
        //
    }

    public function post(Post $post)
    {

        $posts=Post::all();

        // $postComments=PostComment::orderBy('created_at','desc')->get();
        $postComments=PostComment::orderBy('created_at','desc')
        ->where('post_id','=',$post->id)
        ->paginate(10);
        // dd($postComments);
        // dd($postComments[0]->user);
        // dd($postComments);
        return view('dashboard.post-comment.post',[
            'postComments'=>$postComments,
            'posts'=>$posts,
            'post'=>$post
        
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        // $postComment= PostComment::find($id);
        // $postComment= PostComment::findOrFail($id);
        // dd($postComment);
        // if(isset($postComment)){
        //     return view('dashboard.postComment.show',["postComment"=>$postComment]);
        // }
        return view('dashboard.post-comment.show',["postComment"=>$postComment]);
        
    }

    public function jshow(PostComment $postComment)
    {
        // echo 'estamos aqui';
        // $postComment= PostComment::find($id);
        // $postComment= PostComment::findOrFail($id);
        // dd($postComment);
        // if(isset($postComment)){
        //     return view('dashboard.postComment.show',["postComment"=>$postComment]);
        // }
        return response()->json($postComment);
        
    }
    public function proccess(PostComment $postComment)
    {
        // dd($postComment);
        
        if($postComment->approved=='0'){
            $postComment->approved='1';
        }else{
            $postComment->approved='0';
        }
        $postComment->save();
       
        return response()->json($postComment->approved);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        // echo 'Eliminado';
        $postComment->delete();
        return back()->with('status', 'Commentario eliminado con exito');
    }
}
