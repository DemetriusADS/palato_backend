<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Venda;

class VendaService
{
    public function create($venda)
    {
        \DB::beginTransaction();
        try {
            $created = Venda::create($venda);
            \DB::commit();
            return response()->json($created, 201);
        } catch (\Exception $error) {
            \DB::rollBack();
            return response(500);
        }
        return response()->json($created);
    }

    public function list($filters = [])
    {
        $vendas = Venda::with(['pedidos'])->where(function ($query) use (&$filters) {

            if (isset($filters['nome']) && !empty($filters['nome']))
                $query->where('nome', 'ilike', "%" . $filters['nome'] . "%");
        })->orderBy('id', 'desc')->paginate(10);

        return response()->json($vendas);
    }
    public function update($venda, $id)
    {
        //Se o status do pedido mudar para * cancelado *, deve-se retornar os picoles para o lote;

        $vendaUpdated = Venda::find($id);
        $isUpdated = $vendaUpdated->update($venda);
        return $isUpdated ? response()->json($vendaUpdated, 200) : response("", 500);
    }
    public function delete($id)
    {
        //Ao, deve-se retornar os picoles para o lote;

        $venda = Venda::find($id);
        $delete = $venda->delete();
        return $delete ? response("", 200) : response("", 500);
    }
}
