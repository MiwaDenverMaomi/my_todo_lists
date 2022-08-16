<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        // $id=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
        return [
            'user_id'=>$this->faker->numberBetween($min=1,$max=20),            'photo'=>$this->faker->imageUrl($width=600,$height=600,$category='cats',$randomize=true,$word=null),
            'question_1'=>$this->faker->realText($maxNbChars=300, $indexSize=2),
            'question_2'=>$this->faker->realText($maxNbChars=300, $indexSize=2),
            'question_3'=>$this->faker->realText($maxNbChars=300, $indexSize=2),
        ];
    }
}
