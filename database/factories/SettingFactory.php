<?php

namespace Database\Factories;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $key = fake()->unique()->word();

        return [
            'key' => Str::slug($key),
            'value' => ['enabled' => true],
            'group' => 'general',
            'updated_by' => User::factory()->admin(),
        ];
    }
}
