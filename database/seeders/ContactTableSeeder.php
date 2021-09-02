<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();
      
    
        for($i =1 ;$i<=20;$i++ ){
            Contact::create([
                   'name'=>"Marco $i ",
                   'surname'=>"Cardenas $i",
                   'message'=>"Nuevo mensaje",
                   'email'=>"mcardenasp2@gmail.com",
                   
            ]);
        }   
        
    }
}
