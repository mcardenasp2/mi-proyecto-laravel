<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Database\Seeder;

class PostImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::truncate();
        // Category::create([
        //     'title'=>'Categoria 1',
        //     'url_clean'=>'categoria-1'
        // ]);
        $posts=Post::all();
        foreach($posts as $key=>$p){
            // for($i =1 ;$i<=20;$i++ ){
                PostImage::create([
                   'image'=>"1624321061.jpg",
                   
                   'post_id'=>$p->id,
                   
               ]);
           }   
        // }
    }
}
