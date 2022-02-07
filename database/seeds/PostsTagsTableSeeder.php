<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //voglio che questa tabella abbia 30 record
        //devo prima estrarre random un post, poi estrarre random l'id di un tag e associarlo al post estratto nella tabella ponte
        for($i=0; $i < 30; $i++) {
            $post = Post::inRandomOrder()->first();
            $tag_id = Tag::inRandomOrder()->first()->id;

            //riga che equivale al save(): uso tags() come metodo del model Post e poi faccio attach() dell'id estratto:
            $post->tags()->attach($tag_id);
        }
    }
}
