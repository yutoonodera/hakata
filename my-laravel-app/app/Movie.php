<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    const UPLOAD_DIR = '/uploads/movie/';
    const THUMBNAIL_FILE_PREFIX = 'thumbnail';
    const MOVIE_FILE_PREFIX = 'movie';
    const OPEN_STATUS = 1;
    protected $fillable = [
        'thumbnail_file',
        'movie_file',
        'title',
        'start_date',
        'end_date',
        'minutes',
        'product1',
        'price1',
        'product2',
        'price2',
    ];
}
