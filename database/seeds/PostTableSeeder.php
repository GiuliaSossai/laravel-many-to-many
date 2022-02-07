<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $new_post->content = $faker->text();
            $new_post->slug = Post::createSlug($new_post->title);

            $new_post->save();
        }
    }
}
