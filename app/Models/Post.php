<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        "slug",
        "user_id",


    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //many post maybe have the same tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //the one image is belong to one post but one post maybe has many images
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
