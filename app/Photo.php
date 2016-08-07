<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $fillable = [
        'file_name', 'file_size', 'file_mime', 'file_path',
    ];
}
