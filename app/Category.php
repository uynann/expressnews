<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function postsPublished() {
        return $this->posts()->where('status', '=', 'publish');
    }

//    public function setNameAttribute($value)
//    {
//        return ucfirst($value);
//    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
