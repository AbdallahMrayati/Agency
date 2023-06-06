<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',

    ];


    // one category belongs to many posts on portofolio
    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function pricing()
    {
        return $this->belongsToMany(Pricing::class);
    }
}
