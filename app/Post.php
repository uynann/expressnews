<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'body', 'user_id', 'photo_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
