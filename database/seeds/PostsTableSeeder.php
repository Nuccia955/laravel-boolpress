<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            $new_post = new Post();

            $new_post->title = 'Post title' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->body = 'Text' . ($i + 1);

            $new_post->save();
        }
    }
}
