<?php

namespace Database\Factories;

use App\Enums\AvailabilityStatus;
use App\Models\ModeratorProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ModeratorProfile>
 */
class ModeratorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $displayName = fake()->name();

        return [
            'user_id' => User::factory()->moderator(),
            'username' => Str::slug($displayName).'-'.fake()->unique()->numberBetween(100, 999),
            'display_name' => $displayName,
            'bio' => fake()->paragraph(),
            'avatar_path' => null,
            'contact_information' => [
                'whatsapp' => '+8801700000000',
                'facebook' => 'https://facebook.com/'.fake()->userName(),
            ],
            'availability_status' => AvailabilityStatus::Available,
            'last_seen_at' => now(),
        ];
    }

    public function busy(): static
    {
        return $this->state(fn (array $attributes) => [
            'availability_status' => AvailabilityStatus::Busy,
        ]);
    }

    public function offline(): static
    {
        return $this->state(fn (array $attributes) => [
            'last_seen_at' => now()->subMinutes(10),
        ]);
    }
}
