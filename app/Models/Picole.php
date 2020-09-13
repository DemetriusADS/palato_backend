<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Lote;

class Picole extends Model
{
    protected $table = "picole";

    protected $fillable = ["sabor", "qtd_lotes"];

    protected $hidden = ['deleted_at'];

    public function lotes()
    {
        return $this->hasMany(Lote::class)->orderBy('created_at', 'desc');
    }
}
