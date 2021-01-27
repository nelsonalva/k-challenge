<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        App\Models\User::factory()->count(3)->create();
        App\Models\Post::factory()->count(30)->create();
        App\Models\Comment::factory()->count(200)->create();
    }
}
