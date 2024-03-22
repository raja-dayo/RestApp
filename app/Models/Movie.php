<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'casts',
        'release_date',
        'director',
        'ratings'
    ];

    public function getCastsAttribute($value)
    {
        return  json_decode($value);
    }

    public function getRatingsAttribute($value)
    {
        return  json_decode($value);
    }
}