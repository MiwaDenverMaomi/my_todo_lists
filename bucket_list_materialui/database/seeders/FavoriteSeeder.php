<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Favorite::create([
            'from_user'=>1,
            'to_user'=>2
        ]);
          Favorite::create([
            'from_user'=>1,
            'to_user'=>3
        ]);
           Favorite::create([
            'from_user'=>1,
            'to_user'=>4
        ]);
            Favorite::create([
            'from_user'=>1,
            'to_user'=>5
        ]);
          Favorite::create([
            'from_user'=>2,
            'to_user'=>1
        ]);
          Favorite::create([
            'from_user'=>2,
            'to_user'=>2
        ]);
          Favorite::create([
            'from_user'=>2,
            'to_user'=>3
        ]);
          Favorite::create([
            'from_user'=>2,
            'to_user'=>4
        ]);
    }
}
