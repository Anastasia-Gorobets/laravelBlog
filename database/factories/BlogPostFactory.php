<?php

namespace Database\Factories;

use App\Models\User;
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

        $users = User::all();
        $user_id = $users->random()->id;
        return $this->state([
            'title'=>'New title 1',
            'content'=>'New content 1',
            'user_id'=>$user_id,
            'created_at'=>$this->faker->dateTimeBetween('-3 months')
        ]);
    }


}
