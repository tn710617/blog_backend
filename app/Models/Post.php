<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{

    use HasFactory;

    protected $fillable = [
        'post_title', 'post_content', 'category_id', 'created_at', 'updated_at', 'is_public', 'locale', 'user_id'
    ];

    protected $casts = ['is_public' => 'boolean'];

    /**
     * Relations
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Attributes
     */
    protected function locale(): Attribute
    {
        return Attribute::make(get: function (string $value) {
            return Str::replace('_', '-', $value);
        }, set: function (string $value) {
            return Str::replace('-', '_', $value);
        });
    }

    /**
     * Scopes
     */
    public function scopeOfSearch(Builder $query, string $keyword = null)
    {
        collect(str_getcsv($keyword, ' '))->filter()->each(function (string $term) use ($query) {
            $term = "%{$term}%";
            $query->where(function (Builder $query) use ($term) {
                $query->where('post_title', 'like', $term)
                    ->orWhere('post_content', 'like', $term);
            });
        });
    }
}
