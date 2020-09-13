<?php

namespace App\Services;

use App\Models\Lote;
use Illuminate\Support\Facades\DB;
use App\Models\Picole;

class LoteService
{
    public function create($lote)
    {
        DB::beginTransaction();
        try {
            $lote['quantidade_restante'] = $lote['quantidade_total'];
            $created = Lote::create($lote);
            if ($created) {
                $picole = Picole::find($lote['picole_id']);
                $newQtdLotes = $picole['qtd_lotes'] + 1;
                $picole->update(['qtd_lotes' => $newQtdLotes]);
                $created->update(['lote_ref' => $newQtdLotes]);
            }
            DB::commit();
            return response()->json($created, 201);
        } catch (\Exception $error) {
            DB::rollBack();
            return response("", 500);
        }
        return response()->json($created);
    }

    public function list($filters = [])
    {

        $lotes = Lote::with(['picole'])->where(function ($query) use (&$filters) {

            if (isset($filters['nome']) && !empty($filters['nome']))
                $query->where('nome', 'ilike', "%" . $filters['nome'] . "%");
        })->orderBy('id', 'desc')->paginate(10);

        return response()->json($lotes);
    }

    public function update($lote, $id)
    {
        $loteUpdated = Lote::find($id);
        $isUpdated = $loteUpdated->update($lote);
        return $isUpdated ? response()->json($loteUpdated, 200) : response("", 500);
    }

    public function delete($id)
    {
        $lote = Lote::find($id);
        $delete = $lote->delete();
        if ($delete) {
            $picole = Picole::find($lote['picole_id']);
            $newQtdLotes = $picole['qtd_lotes'] - 1;
            $picole->update(['qtd_lotes' => $newQtdLotes]);
        }
        return $delete ? response("", 200) : response("", 500);
    }
}
