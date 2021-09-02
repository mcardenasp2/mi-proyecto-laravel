<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ContactController;
use App\Http\Controllers\dashboard\PostCommentController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PostController;
use App\Http\Controllers\dashboard\PostController;
use App\Http\Controllers\web\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/casa', function () {
    return view('welcome');
})->name('casa');

// Route::get('/acerca-de', function () {
//     return "Hola marc";
// });

// Route::get('/sobre-nosotros', function () {
//     return "<h1>Hola </h1>";
// });


// Route::get('/hola/{nombre}/{apellido}', function ($nombre,$apellido) {
//     return "<h1>Hola $nombre, $apellido </h1><a href='".route("nosotros")."'>nosotros</a>";
// });

// Route::get('/nosotrosmismo', function () {
//     return "<h1>Todos</h1>";
// })->name("nosotros");


// Route::get('home/{nombre?}/{apellido?}', function ($nombre="Pepe",$apellido="Cardenas") {
//     // $nombre="Marcoss";
//     // return view('home')->with("nombre",$nombre)->with("apellido",$apellido);
//     $post =['post1','post2','post3'];
    
//     return view('home',['nombre'=>$nombre,'apellido'=>$apellido,'posts'=>$post]);

    
// })->name("home");

// Route::get('post',[PostController::class,'index'] );
Route::resource('dashboard/post', PostController::class);
Route::post('dashboard/post/{post}/image', [PostController::class, 'image'])->name('post.image');

Route::post('dashboard/post/content_image', [PostController::class, 'contentImage']);


Route::resource('dashboard/category', CategoryController::class);
Route::resource('dashboard/user', UserController::class);

Route::resource('dashboard/contact', ContactController::class)->only([
    'index','show','destroy'
]);
Route::resource('dashboard/post-comment', PostCommentController::class)->only([
    'index','show','destroy'
]);

Route::get('dashboard/post-comment/{post}/post', [PostCommentController::class,'post'])->name('post-comment.post');
Route::get('/dashboard/post-comment/j-show/{postComment}', [PostCommentController::class,'jshow']);
Route::post('/dashboard/post-comment/proccess/{postComment}', [PostCommentController::class,'proccess']);


// api
Route::get('/',  [WebController::class, 'index'])->name('index');
Route::get('/detail/{id}',  [WebController::class, 'detail']);
Route::get('/post-category/{id}',  [WebController::class, 'post_category']);
Route::get('/categories',  [WebController::class, 'categories'])->name('categories');
Route::get('/contact',  [WebController::class, 'contact']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
