<?php

namespace Database\Factories;

use App\Enums\AnnouncementPriority;
use App\Enums\AnnouncementStatus;
use App\Enums\AnnouncementType;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'created_by' => User::factory()->admin(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'body' => fake()->paragraphs(2, true),
            'locale' => 'bn',
            'type' => AnnouncementType::Announcement,
            'priority' => AnnouncementPriority::Normal,
            'status' => AnnouncementStatus::Published,
            'starts_at' => null,
            'ends_at' => null,
            'published_at' => now(),
        ];
    }

    public function scamAlert(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => AnnouncementType::ScamAlert,
            'priority' => AnnouncementPriority::Urgent,
        ]);
    }

    public function safetyNotice(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => AnnouncementType::SafetyNotice,
            'priority' => AnnouncementPriority::High,
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => AnnouncementStatus::Draft,
            'published_at' => null,
        ]);
    }
}
