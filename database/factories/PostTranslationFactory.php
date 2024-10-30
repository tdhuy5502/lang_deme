<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostTranslation>
 */
class PostTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'lang_id' => Language::factory(),
            'post_id' => Post::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
