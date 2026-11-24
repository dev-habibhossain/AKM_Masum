<?php

namespace Database\Seeders;

use App\Models\ContentCategory;
use Illuminate\Database\Seeder;

class ContentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Gaming Tips',
                'slug' => 'gaming-tips',
                'description' => 'Gameplay tips, tricks, and strategies.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Community Updates',
                'slug' => 'community-updates',
                'description' => 'Community news, event updates, and announcements.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Gameplay Highlights',
                'slug' => 'gameplay-highlights',
                'description' => 'Exciting gameplay moments and highlight clips.',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            ContentCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
