<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
        $user_ids = DB::table('users')->pluck('id')->all();

        return [
            'title' => $this->faker->realText(15),
            'slug' => $this->faker->realText(10),
            'content' => $this->faker->realText(200),
            'is_published' => $this->faker->boolean(),
            'is_protected' => $this->faker->boolean(),
            'user_id' => $this->faker->randomElement($user_ids),
        ];
    }
}
