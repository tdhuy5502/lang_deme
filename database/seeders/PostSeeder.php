<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = Language::factory()->count(3)->create();
        
        Post::factory()->count(3)->create()->each(function($post) use ($langs){
            $langs->each(function($lang) use ($post){
                PostTranslation::factory()->create([
                    'post_id' => $post->id,
                    'lang_id' => $lang->id
                ]);
            });
        });
    }
}
