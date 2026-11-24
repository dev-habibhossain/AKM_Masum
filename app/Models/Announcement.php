<?php

namespace App\Models;

use App\Enums\AnnouncementPriority;
use App\Enums\AnnouncementStatus;
use App\Enums\AnnouncementType;
use Database\Factories\AnnouncementFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $created_by
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $locale
 * @property AnnouncementType $type
 * @property AnnouncementPriority $priority
 * @property AnnouncementStatus $status
 * @property Carbon|null $starts_at
 * @property Carbon|null $ends_at
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User $creator
 */
#[Fillable([
    'created_by',
    'title',
    'slug',
    'body',
    'locale',
    'type',
    'priority',
    'status',
    'starts_at',
    'ends_at',
    'published_at',
])]
class Announcement extends Model
{
    /** @use HasFactory<AnnouncementFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => AnnouncementType::class,
            'priority' => AnnouncementPriority::class,
            'status' => AnnouncementStatus::class,
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('status', AnnouncementStatus::Published)
            ->where(function (Builder $subQuery): void {
                $subQuery->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function (Builder $subQuery): void {
                $subQuery->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });
    }

    #[Scope]
    protected function scamAlerts(Builder $query): Builder
    {
        return $query->where('type', AnnouncementType::ScamAlert);
    }
}
