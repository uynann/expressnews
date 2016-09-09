<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $fillable = [
        'file_name', 'file_size', 'file_mime', 'file_path', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }


    public function getFileSizeAttribute($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
