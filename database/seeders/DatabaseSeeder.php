<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoryTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PostImageTableSeeder::class);

        $this->call(ContactTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);

    }
}
