<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'AKM MASUM',
                'group' => 'general',
            ],
            [
                'key' => 'default_locale',
                'value' => 'bn',
                'group' => 'general',
            ],
            [
                'key' => 'supported_locales',
                'value' => ['bn', 'en'],
                'group' => 'general',
            ],
            [
                'key' => 'presence_timeout_seconds',
                'value' => 180,
                'group' => 'presence',
            ],
            [
                'key' => 'heartbeat_interval_seconds',
                'value' => 60,
                'group' => 'presence',
            ],
            [
                'key' => 'homepage_safety_notice_enabled',
                'value' => true,
                'group' => 'announcements',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
