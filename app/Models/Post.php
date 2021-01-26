<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'slug', 'is_published', 'is_protected', 'user_id'
    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
