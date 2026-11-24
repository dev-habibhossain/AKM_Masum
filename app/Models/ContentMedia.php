<?php

namespace App\Models;

use Database\Factories\ContentMediaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $content_id
 * @property string $file_path
 * @property string|null $alt_text
 * @property string $mime_type
 * @property int $file_size
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Content $content
 */
#[Fillable([
    'content_id',
    'file_path',
    'alt_text',
    'mime_type',
    'file_size',
    'sort_order',
])]
class ContentMedia extends Model
{
    /** @use HasFactory<ContentMediaFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_media';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
