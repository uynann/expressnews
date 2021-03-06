<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = [
        'comment_id', 'user_id', 'is_active', 'reply', 'post_id', 'to_user',
    ];

    public function comment() {
        return $this->belongsTo('App\Comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function userReply() {
        return $this->belongsTo('App\User', 'to_user');
    }


    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("reply", "LIKE","%$keyword%");
            });
        }
        return $query;
    }
}
