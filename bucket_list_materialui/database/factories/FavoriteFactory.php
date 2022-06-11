<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_user'=>$this->faker->numberBetween($min=1,$max=20),
            'to_user'=>$this->faker->numberBetween($min=1,$max=20)
        ];
    }
}
