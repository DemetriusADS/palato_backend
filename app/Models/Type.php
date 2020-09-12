<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $hidden = ['id'];
    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
}
