<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'photo_id', 'role_id', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin() {
        if ($this->role->name == 'Administrator') {
            return true;
        } else {
            return false;
        }
    }

    public function isEditor() {
        if ($this->role->name == 'Editor') {
            return true;
        } else {
            return false;
        }
    }

    public function isAuthor() {
        if ($this->role->name == 'Author') {
            return true;
        } else {
            return false;
        }
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function replies() {
        return $this->hasMany('App\CommentReply');
    }


    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("username", "LIKE","%$keyword%")
                    ->orWhere("firstname", "LIKE", "%$keyword%")
                    ->orWhere("lastname", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
