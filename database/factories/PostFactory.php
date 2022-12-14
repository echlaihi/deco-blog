<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'  => $this->faker->sentence(),
            'body'   => $this->withFaker()->text(5000), 
            'user_id'=> 1,
            'category_id' => 1,
            'img'    => null,
        ];
    }
}
