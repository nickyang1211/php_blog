<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title', 
        'body', 
        'record', 
        'author', 
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function booted()
    {
        static::deleting(function (Blog $blog){
            $blog->comments()->each(function (Comment $comment) {
                $comment->delete();
            });
        });
    }

    protected $casts = [
        'record' => 'array',
    ];


    
}
