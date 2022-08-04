<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Bucket_listFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween($min=1,$max=20),
            'bucket_list_item'=>$this->faker->realText($maxNbChars=255,$indexSize=2),
            'is_done'=>$this->faker->boolean( $chanceOfGettingTrue=50
            )
        ];
    }
}
