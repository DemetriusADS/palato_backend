<?php

namespace App\Services;

use App\Models\Picole;

class PicoleService
{
    public function create($picole)
    {
        \DB::beginTransaction();
        try {
            $created = Picole::create($picole);
            \DB::commit();
            return response()->json($created, 201);
        } catch (\Exception $error) {
            DB::rollBack();
            return response("", 500);
        }
        return response()->json($created);
    }

    public function list($filters = [])
    {
        $picoles = Picole::with(['lotes'])->where(function ($query) use (&$filters) {

            if (isset($filters['sabor']) && !empty($filters['sabor']))
                $query->where('sabor', 'ilike', "%" . $filters['sabor'] . "%");
        })->orderBy('sabor', 'desc')->paginate(10);

        return response()->json($picoles);
    }
    public function update($picole, $id)
    {
        $picoleUpdated = Picole::find($id);
        $isUpdated = $picoleUpdated->update($picole);
        return $isUpdated ? response()->json($picoleUpdated, 200) : response("", 500);
    }
    public function delete($id)
    {
        $picole = Picole::find($id);
        $delete = $picole->delete();
        return $delete ? response("", 200) : response("", 500);
    }
}
