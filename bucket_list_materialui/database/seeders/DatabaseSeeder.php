<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(20)->create();
        \App\Models\Profile::factory(20)->create();
        \App\Models\Like::factory(20)->create();
        \App\Models\Favorite::factory(20)->create();
        \App\Models\Bucket_list::factory(20)->create();
        // \App\Models\Profile::truncate();
        // \App\Models\Like::truncate();
        // \App\Models\Bucket_list::truncate();
        // \App\Models\Favorite::truncate();
        // \App\Models\User::truncate();



    }
}
