<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class tagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        // Category::create([
        //     'title'=>'Categoria 1',
        //     'url_clean'=>'categoria-1'
        // ]);
        for($i =1 ;$i<=20;$i++ ){
             Tag::create([
                'title'=>"tag $i",
                
            ]);
        }
    }
}
