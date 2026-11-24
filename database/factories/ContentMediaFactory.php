<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\ContentMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContentMedia>
 */
class ContentMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content_id' => Content::factory(),
            'file_path' => 'uploads/content/'.fake()->uuid().'.webp',
            'alt_text' => fake()->sentence(3),
            'mime_type' => 'image/webp',
            'file_size' => fake()->numberBetween(50000, 500000),
            'sort_order' => 0,
        ];
    }
}
