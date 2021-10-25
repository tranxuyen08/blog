<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'thumbnail',
        'excerpt',
        'body',
        'published_at'
    ];

    protected static function booted()
    {
        static::addGlobalScope('phandong', function (Builder $builder) {
            $builder->where('title', 'not like', 'phan dong');
        });
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeCuong($query, $id)
    {
        return $query->where('user_id', $id);
    }
}
