<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'description',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

//    public function setNameAttribute($value)
//    {
//        return ucfirst($value);
//    }
}
