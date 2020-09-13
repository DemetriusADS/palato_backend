<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Pedido;
use App\Models\Venda;
use App\Models\Lote;

class PedidoService
{
    public function create($pedidos)
    {
        //Pedido vai ser um objeto com: lote_id, quantidade;
        //AO clicar em enviar pedido, sera criado uma venda.
        //O venda.id será passado para pedido['venda_id'];
        //Ao criar o pedido, deve-se retirar a quantidade de itens do lote de refencia;
        DB::beginTransaction();

        try {
            $return = [];
            $venda = Venda::create();
            foreach ($pedidos as $pedido) {
                $pedido['venda_id'] = 1;
                // array_push($pedido, ['venda_id' => $venda['id']]);
                $pedido['venda_id'] = $venda['id'];
                $createPedido = Pedido::create($pedido);
                if ($createPedido) {
                    $loteRef = Lote::find($pedido['lote_id']);
                    $loteRef['quantidade_total'] -= $pedido['quantidade'];
                    $loteRef->update(['quantidade_total' => $loteRef['quantidade_total']]);
                }
                array_push($return, $createPedido);
            }
            DB::commit();
            return response()->json(["pedido" => $venda['id'], "items" => $return]);
        } catch (\Exception $error) {
            DB::rollBack();
            return response($error, 500);
        }
    }

    public function list($filters = [])
    {
        $pedidos = Pedido::with('venda')->where(function ($query) use (&$filters) {

            if (isset($filters['nome']) && !empty($filters['nome']))
                $query->where('nome', 'ilike', "%" . $filters['nome'] . "%");
        })->orderBy('id', 'desc')->paginate(10);

        return response()->json($pedidos);
    }

    public function update($pedido, $id)
    {
        $pedidoUpdated = Pedido::find($id);
        $isUpdated = $pedidoUpdated->update($pedido);
        return $isUpdated ? response()->json($pedidoUpdated, 200) : response("", 500);
    }

    public function delete($id)
    {
        $pedido = Pedido::find($id);
        $delete = $pedido->delete();
        return $delete ? response("", 200) : response("", 500);
    }
}
