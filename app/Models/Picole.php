<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picole extends Model
{
    protected $table = "picole";

    protected $fillable = ["sabor", "qtd_lotes"];

    public function lotes()
    {
        return $this->hasMany('App\Models\Lote', 'sabor_id', 'id');
    }
}
