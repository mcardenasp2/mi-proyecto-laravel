<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        // Category::create([
        //     'title'=>'Categoria 1',
        //     'url_clean'=>'categoria-1'
        // ]);
        $categories=Category::all();
        foreach($categories as $key=>$c){
            for($i =1 ;$i<=20;$i++ ){
                Post::create([
                   'title'=>"Categoria $i $key",
                   'url_clean'=>"categoria-$i-$key",
                   'category_id'=>$c->id,
                   'content'=>"Nuevo Contenido",
                   'posted'=>'yes'
               ]);
           }   
        }
        
    }
}
