<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    protected $fillable = ['post_title', 'post_content', 'category_id', 'created_at', 'updated_at', 'is_public', 'locale'];

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
}
