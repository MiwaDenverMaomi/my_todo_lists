<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;
class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Like::create([
            'from_user'=>1,
            'to_user'=>2
        ]);
          Like::create([
            'from_user'=>1,
            'to_user'=>3
        ]);
           Like::create([
            'from_user'=>1,
            'to_user'=>4
        ]);
            Like::create([
            'from_user'=>1,
            'to_user'=>5
        ]);
          Like::create([
            'from_user'=>2,
            'to_user'=>1
        ]);
          Like::create([
            'from_user'=>2,
            'to_user'=>2
        ]);
          Like::create([
            'from_user'=>2,
            'to_user'=>3
        ]);
          Like::create([
            'from_user'=>2,
            'to_user'=>4
        ]);
    }
}
