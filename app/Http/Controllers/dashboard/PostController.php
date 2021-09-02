<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\CustomUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostPost;
use App\Http\Requests\UpdatePostPut;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Tag;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
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
        
        /*DB::transaction(function(){
            // DB::table('contacts')
            // ->where(["id"=>1])
            // ->delete();
            // DB::table('contacts')
            // ->where(["id"=>10])
            // ->update(['name'=>"Pepito"]);
            $contacto=DB::select('select * from contacts where id=?',[5]);
            dd($contacto[0]);

        });
        */
        // DB::beginTransaction();
            // $contacto=DB::select('select * from contacts where id=?',[5]);
            // commit para que se realice
        // DB::commit();
        // para evitar que se realice
        // DB::rollBack();

        $personas=[
            ["nombre"=>"Marco","edad"=>50],
            ["nombre"=>"Marco 2","edad"=>40],
            ["nombre"=>"Marco 3","edad"=>30],
        ];
        // dd($personas);
        $collection1 =collect($personas);
        // dd($collection1);
        $collection2 = new Collection($personas);
        // dd($collection2);
        $collection3 = Collection::make($personas);
        // dd($collection3);
        // dd($collection2->filter(function($value,$key){
        //     // dd($value['edad']);
        //     return $value['edad']>30;
        // })
        // ->sum('edad'));
        $personas=
            ["nombre"=>"Marco","Marco2","Marco3","Marco2"];
            
        
        $collection =collect($personas);
        // dd((bool)$collection->intersect(['Marco2'])->count());
        // $posts=Post::orderBy('created_at','desc')->get();
        // with agiliza las consultas relacionadas
        // con tablas relacionadas
        $posts=Post::with('category')->orderBy('created_at','desc')->paginate(10);
        // dd($posts);
        return view('dashboard.post.index',['posts'=>$posts]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::pluck('id','title');
        // cuando no es de manera estatica
        // $p = new CustomUrl();
        // $p->hola_mundo();
        // CustomUrl::hola_mundo();
        $post=new Post();
        $categories= Category::pluck('id','title');
        return view('dashboard.post.create',
        compact('post','categories','tags')
        // ['post'=>new Post(),'categories'=>$categories,'tags'=>$tags]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostPost $request)
    {
        //echo "Hola mundo ".$request->input('title');
        //dd($request->all());
        // $request->validate([
        //     'title'=>'required|min:5|max:500',
        //     'content'=>'required|min:5'
        // ]);
        // dd($request->validated());
       
        if ($request->url_clean==""){
            $urlClean=CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title),'-',true);
        }else{
            $urlClean=CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->url_clean),'-',true);

        }
        // echo "hola ".$urlClean;
        $requestData=$request->validated();
        $requestData['url_clean']=$urlClean;
        // de nuevo Valida

        $validator=Validator::make($requestData,StorePostPost::myRules());
        // dd($requestData);

        if($validator->fails()){
            // echo "errores";
            return redirect('dashboard/post/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        $post=Post::create($requestData);
        // sincronizamos las etiquetas
        $post->tags()->sync($request->tags_id);
            

        // Post::create($request->validated());
        return back()->with('status', 'Post creado con exito');
    }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post= Post::find($id);
        // $post= Post::findOrFail($id);
        // dd($post);
        // if(isset($post)){
        //     return view('dashboard.post.show',["post"=>$post]);
        // }
        return view('dashboard.post.show',["post"=>$post]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post->tags->pluck("id"));
        // dd($post->tags);
        $tag= Tag::find(1);
        // me devuelve valores especificos
        $tags=Tag::pluck('id','title');
        // dd($tag->posts);
        $categories= Category::pluck('id','title');
        // dd($categories);
        return view('dashboard.post.edit',
        compact('post','categories','tags')
        // ["post"=>$post,'categories'=>$categories,'tags'=>$tags]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostPut $request, Post $post)
    {
        // dd($request->tags_id);
        // $post->tags()->attach(1);
        // $post->tags()->detach(1);
        $post->tags()->sync($request->tags_id);
        $post->update($request->validated());
        return back()->with('status', 'Post actualizado con exito');
    }

    public function image(Request $request, Post $post)
    {
        $request->validate([
            // 10Mb
            'image'=>'required|mimes:jpeg,bmp,png|max:10240'
        ]);
        $filename=time().".".$request->image->extension();
        // movemos el elemento
        // $request->image->move(public_path('images'), $filename);
        // $path=$request->image->store('public');

        PostImage::create(['image'=>$filename, 'post_id'=>$post->id]);
        // PostImage::create(['image'=>$path, 'post_id'=>$post->id]);
        return back()->with('status', 'Imagen Cargada con exito');
        // echo 'hola mundo '.$filename;
    }

    public function contentImage(Request $request)
    {
        $request->validate([
            'image'=>'required|mimes:jpeg,bmp,png|max:10240'
        ]);
        $filename=time().".".$request->image->extension();
        // movemos el elemento
        $request->image->move(public_path('images_post'), $filename);

        return response()->json(["default"=>URL::to('/').'/images_post/'.$filename]);
        // PostImage::create(['image'=>$filename, 'post_id'=>$post->id]);
        // return back()->with('status', 'Imagen Cargada con exito');
        // echo 'hola mundo '.$filename;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // echo 'Eliminado';
        $post->delete();
        return back()->with('status', 'Post eliminado con exito');
    }
}
