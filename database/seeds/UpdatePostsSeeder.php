<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //voglio che il seeder estragga random l'id di una categoria
        //devo prendere tutti i post, ciclarli e assegnare a ciasuno l'id random
        $posts = Post::all();

        foreach($posts as $post){
            $post->category_id = Category::inRandomOrder()->first()->id;

            $post->update();
        }
    }
}
