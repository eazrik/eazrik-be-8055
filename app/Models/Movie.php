<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'genre',
        'performer',
        'director',
        'theater_name',
        'views',
        'likes',
        'ratings',
        'release',
        'start_at',
        'end_at',
        'length',
    ];
}
