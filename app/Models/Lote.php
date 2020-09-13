<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Picole;

class Lote extends Model
{
    protected $table = "picole_lote";

    protected $guarded = [];

    public function picole()
    {
        return $this->belongsTo(Picole::class, "picole_id");
    }
}
