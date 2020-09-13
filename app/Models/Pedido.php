<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $guarded = [];

    public function lote()
    {
        return $this->belongsTo("App\Models\Lote", "lote_id");
    }

    public function venda()
    {
        return $this->belongsTo("App\Models\Venda", "venda_id");
    }
}
