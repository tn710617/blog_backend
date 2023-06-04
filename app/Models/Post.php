<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
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
        });
    }
}
