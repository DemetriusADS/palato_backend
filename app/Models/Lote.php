<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = "picole_lote";

    protected $guarded = [];

    public function picoles()
    {
        return $this->belongsTo('App\Models\Picole');
    }
}
