<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use HasFactory;

    public $timestamps = false;

    public static function getValidIds(): array
    {
        return self::all()->pluck('id')->toArray();
    }

    /**
     * Relations
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Scopes
     */
    public function scopeOfPopular(Builder $query)
    {
        return $query->orderBy('used_at', 'desc');
    }
}
