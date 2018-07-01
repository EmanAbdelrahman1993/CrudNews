<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    protected $fillable=[
        'user_id',
        'title',
        'description',
        'content',
        'photo'
    ];

    public function addBy()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function Images()
    {
        return $this->hasMany('App\Images','news_id','id');
    }
}
