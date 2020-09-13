<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';

    protected $guarded = [];

    public function pedidos()
    {
        return $this->hasMany("App\Models\Pedido");
    }

    public function metodoPagamento()
    {
        return $this->hasOne('App\Models\MetodoPagamento');
    }
}
