<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title'=>$this->faker->sentence(1),
            'content'=>$this->faker->paragraph(3,true),
            'created_at'=>$this->faker->dateTimeBetween('-3 months')
        ];
    }


    public function newTitle()
    {
        return $this->state([
            'title'=>'New title 1',
            'content'=>'New content 1',
            'created_at'=>$this->faker->dateTimeBetween('-3 months')
        ]);
    }


}
