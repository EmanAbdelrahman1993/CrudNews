<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable=[
        'user_id',
        'news_id',
        'path',
        'image',
        'size',
        'image_name'
    ];
}