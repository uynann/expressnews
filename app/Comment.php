<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'is_active', 'comment',
    ];

    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function replies() {
        return $this->hasMany('App\CommentReply');
    }

    public function repliesUnapproved() {
        return $this->replies()->where('is_active', '=', 0);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("comment", "LIKE","%$keyword%");
            });
        }
        return $query;
    }
}
