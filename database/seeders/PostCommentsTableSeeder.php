<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Database\Seeder;

class PostCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostComment::truncate();
        // Category::create([
        //     'title'=>'Categoria 1',
        //     'url_clean'=>'categoria-1'
        // ]);
        $posts=Post::all()->where("id","<=",15);
        foreach($posts as $key=>$post){
            for($i =1 ;$i<=($key+1);$i++ ){
                PostComment::create([
                   'title'=>"este es el titulo del contenido $post->title",
                   'message'=>"Este es el cuerpo del comentario",
                   'user_id'=>4,
                   'post_id'=>$post->id,
                   
               ]);
           }   
        }
    }
}
