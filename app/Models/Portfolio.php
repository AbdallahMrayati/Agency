<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'link',
        "image",
        "category_id",
        "admin_id"

    ];

    //one post on portofolio has only one category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
