<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Modelo;

class ModeloService
{
    public function create($modelo)
    {
        \DB::beginTransaction();
        try {
            $created = Modelo::create($modelo);
            \DB::commit();
            return response()->json($created, 201);
        } catch (\Exception $error) {
            DB::rollBack();
            return response(500);
        }
        return response()->json($created);
    }

    public function list($filters = [])
    {
        $modelos = Modelo::where(function ($query) use (&$filters) {

            if (isset($filters['nome']) && !empty($filters['nome']))
                $query->where('nome', 'ilike', "%" . $filters['nome'] . "%");
        })->orderBy('id', 'desc')->paginate(10);

        return response()->json($modelos);
    }
    public function update($modelo, $id)
    {
        $modeloUpdated = Modelo::find($id);
        $isUpdated = $modeloUpdated->update($modelo);
        return $isUpdated ? response()->json($modeloUpdated, 200) : response("", 500);
    }
    public function delete($id)
    {
        $modelo = Modelo::find($id);
        $delete = $modelo->delete();
        return $delete ? response("", 200) : response("", 500);
    }
}
