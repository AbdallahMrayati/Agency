<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'Image_file_path',

    ];


    //the one image is belong to one post but one post maybe has many images

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
