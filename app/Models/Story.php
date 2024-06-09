<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Arr;


class Story extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'public', 'story_trigger_id'
    ];

    protected $casts = [
        "characters" => "array"
    ];

    /**
     * Get the user's first name.
     */
    protected function summary(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::substr($this->body, 0, 256),
        );
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('images'),
        );
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('images'),
        );
    }

    protected function paragraphs(): Attribute
    {
        return Attribute::make(
            get: fn () => Arr::where(preg_split('/\r\n|\r|\n/', $this->body), function (string|int $value, int $key) {
                return !empty($value);
            })
        );
    } 

    public function storyTrigger(): BelongsTo
    {
        return $this->belongsTo(StoryTrigger::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('mini-thumb')
                    ->fit(Fit::Contain, 100, 100)
                    ->nonQueued();
                $this
                    ->addMediaConversion('thumb')
                    ->fit(Fit::Contain, 300, 300)
                    ->nonQueued();
            });
    }
}
