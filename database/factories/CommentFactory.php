<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $user_ids = DB::table('users')->pluck('id')->all();
        $post_ids = DB::table('posts')->pluck('id')->all();

        return [
            'content' => $this->faker->realText(100),
            'is_published' => $this->faker->boolean(),
            'user_id' => $this->faker->randomElement($user_ids),
            'post_id' => $this->faker->randomElement($post_ids),
        ];
    }
}
