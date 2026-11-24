<?php

namespace App\Models;

use App\Enums\AvailabilityStatus;
use Database\Factories\ModeratorProfileFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $display_name
 * @property string|null $bio
 * @property string|null $avatar_path
 * @property array<string, mixed>|null $contact_information
 * @property AvailabilityStatus $availability_status
 * @property Carbon|null $last_seen_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 */
#[Fillable([
    'user_id',
    'username',
    'display_name',
    'bio',
    'avatar_path',
    'contact_information',
    'availability_status',
    'last_seen_at',
])]
class ModeratorProfile extends Model
{
    /** @use HasFactory<ModeratorProfileFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'contact_information' => 'array',
            'availability_status' => AvailabilityStatus::class,
            'last_seen_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isOnline(int $presenceTimeout = 180): bool
    {
        return $this->last_seen_at !== null
            && $this->last_seen_at->greaterThanOrEqualTo(now()->subSeconds($presenceTimeout));
    }

    public function isAvailable(): bool
    {
        return $this->availability_status === AvailabilityStatus::Available;
    }
}
