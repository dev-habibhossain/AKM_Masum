<?php

use App\Enums\AnnouncementPriority;
use App\Enums\AnnouncementStatus;
use App\Enums\AnnouncementType;
use App\Enums\AvailabilityStatus;
use App\Enums\ContentStatus;
use App\Enums\ContentVisibility;
use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\Content;
use App\Models\ContentCategory;
use App\Models\ContentMedia;
use App\Models\ModeratorProfile;
use App\Models\Setting;
use App\Models\User;

test('users can have roles and statuses', function (): void {
    $admin = User::factory()->admin()->create();
    $moderator = User::factory()->moderator()->create();

    expect($admin->role)->toBe(UserRole::Admin)
        ->and($admin->isAdmin())->toBeTrue()
        ->and($admin->isModerator())->toBeFalse()
        ->and($admin->isActive())->toBeTrue()
        ->and($moderator->role)->toBe(UserRole::Moderator)
        ->and($moderator->isModerator())->toBeTrue()
        ->and($moderator->isAdmin())->toBeFalse();
});

test('moderator profile belongs to a user and has presence helpers', function (): void {
    $user = User::factory()->moderator()->create();
    $profile = ModeratorProfile::factory()->create([
        'user_id' => $user->id,
        'availability_status' => AvailabilityStatus::Available,
        'last_seen_at' => now(),
    ]);

    expect($profile->user->id)->toBe($user->id)
        ->and($user->moderatorProfile->id)->toBe($profile->id)
        ->and($profile->isAvailable())->toBeTrue()
        ->and($profile->isOnline(180))->toBeTrue();

    $profile->update(['last_seen_at' => now()->subMinutes(5)]);
    expect($profile->fresh()->isOnline(180))->toBeFalse();
});

test('content categories categorize contents and support active scope', function (): void {
    $activeCategory = ContentCategory::factory()->create(['is_active' => true]);
    $inactiveCategory = ContentCategory::factory()->inactive()->create();

    expect(ContentCategory::active()->count())->toBeGreaterThanOrEqual(1)
        ->and(ContentCategory::active()->pluck('id'))->toContain($activeCategory->id)
        ->and(ContentCategory::active()->pluck('id'))->not->toContain($inactiveCategory->id);
});

test('contents and media relationships, scopes, and soft deletes work', function (): void {
    $moderator = User::factory()->moderator()->create();
    $category = ContentCategory::factory()->create();

    $publishedContent = Content::factory()->create([
        'user_id' => $moderator->id,
        'category_id' => $category->id,
        'status' => ContentStatus::Published,
        'visibility' => ContentVisibility::Public,
        'is_featured' => true,
        'published_at' => now()->subMinute(),
    ]);

    $draftContent = Content::factory()->draft()->create([
        'user_id' => $moderator->id,
        'category_id' => $category->id,
    ]);

    $media = ContentMedia::factory()->create([
        'content_id' => $publishedContent->id,
    ]);

    expect($publishedContent->category->id)->toBe($category->id)
        ->and($publishedContent->user->id)->toBe($moderator->id)
        ->and($publishedContent->media)->toHaveCount(1)
        ->and($media->content->id)->toBe($publishedContent->id)
        ->and(Content::published()->pluck('id'))->toContain($publishedContent->id)
        ->and(Content::published()->pluck('id'))->not->toContain($draftContent->id)
        ->and(Content::featured()->pluck('id'))->toContain($publishedContent->id);

    // Test soft deletes
    $publishedContent->delete();
    expect(Content::find($publishedContent->id))->toBeNull()
        ->and(Content::withTrashed()->find($publishedContent->id))->not->toBeNull();
});

test('announcements relationships, scopes, and soft deletes work', function (): void {
    $admin = User::factory()->admin()->create();

    $activeAnnouncement = Announcement::factory()->create([
        'created_by' => $admin->id,
        'type' => AnnouncementType::Announcement,
        'priority' => AnnouncementPriority::Normal,
        'status' => AnnouncementStatus::Published,
        'starts_at' => now()->subDay(),
        'ends_at' => now()->addDay(),
    ]);

    $scamAlert = Announcement::factory()->scamAlert()->create([
        'created_by' => $admin->id,
        'status' => AnnouncementStatus::Published,
    ]);

    $draft = Announcement::factory()->draft()->create([
        'created_by' => $admin->id,
    ]);

    expect($activeAnnouncement->creator->id)->toBe($admin->id)
        ->and(Announcement::published()->pluck('id'))->toContain($activeAnnouncement->id)
        ->and(Announcement::published()->pluck('id'))->toContain($scamAlert->id)
        ->and(Announcement::published()->pluck('id'))->not->toContain($draft->id)
        ->and(Announcement::scamAlerts()->pluck('id'))->toContain($scamAlert->id);

    $scamAlert->delete();
    expect(Announcement::find($scamAlert->id))->toBeNull()
        ->and(Announcement::withTrashed()->find($scamAlert->id))->not->toBeNull();
});

test('activity logs record management actions and support polymorphic subjects', function (): void {
    $user = User::factory()->admin()->create();
    $content = Content::factory()->create();

    $log = ActivityLog::create([
        'user_id' => $user->id,
        'action' => 'content.created',
        'subject_type' => Content::class,
        'subject_id' => $content->id,
        'description' => 'Admin created new content',
        'properties' => ['title' => $content->title],
        'ip_address' => '127.0.0.1',
    ]);

    expect($log->user->id)->toBe($user->id)
        ->and($log->subject)->toBeInstanceOf(Content::class)
        ->and($log->subject->id)->toBe($content->id)
        ->and($log->properties['title'])->toBe($content->title);
});

test('settings can be retrieved and updated with helper methods', function (): void {
    $admin = User::factory()->admin()->create();

    Setting::set('site_name', 'AKM Gaming', 'general', $admin->id);

    expect(Setting::get('site_name'))->toBe('AKM Gaming')
        ->and(Setting::get('non_existent', 'default_val'))->toBe('default_val');
});
