<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'email',
        'phoneNumer',
        "company_name",
        "pricing_id",

    ];

    public function pricing()
    {
        return $this->belongsTo(pricing::class);
    }
}
