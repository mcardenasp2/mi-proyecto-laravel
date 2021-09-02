<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\CustomUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryPost;
use App\Http\Requests\UpdateCategoryPut;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(['auth','rol.admin']);
    }

    public function index()
    {
        $category=Category::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.category.index',['categories'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create', ['categories'=>new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPost $request)
    {
        if ($request->url_clean==""){
            $urlClean=CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title),'-',true);
        }else{
            $urlClean=CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->url_clean),'-',true);

        }
        // echo "hola ".$urlClean;
        $requestData=$request->validated();
        $requestData['url_clean']=$urlClean;

        $validator=Validator::make($requestData,StoreCategoryPost::myRules());
        // dd($requestData);

        if($validator->fails()){
            // echo "errores";
            return redirect('dashboard/category/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        // Category::create($request->validated());
        Category::create($requestData);
        return back()->with('status','Cayegory creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show',["categories"=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', ["categories"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryPut $request, Category $category)
    {
        $category->update($request->validated());
        return back()->with('status', 'Categpria Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('status','Categoria eliminado con exito');
    }
}
