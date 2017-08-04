<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // for soft delete
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'title', 'body', 'user_id', 'photo_id', 'status', 'category_id', 'slug', 'view_count',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->timezone('Europe/Moscow')->format('M d, Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->timezone('Europe/Moscow')->format('M d, Y - H:i:s');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function commentsUnapproved() {
        return $this->comments()->where('is_active', '=', 0);
    }

    public function commentsApproved() {
        return $this->comments()->where('is_active', '=', 1);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%");
            });
        }
        return $query;
    }
}
