<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\LoteService;

class LoteController extends Controller
{
    protected $loteService;

    public function __construct(LoteService $loteService)
    {
        $this->loteService = $loteService;
    }

    public function create(Request $request)
    {
        $lote = $request->all();
        return $this->loteService->create($lote);
    }

    public function list(Request $request)
    {
        $lote = $request->all();
        return $this->loteService->list($lote);
    }

    public function update(Request $request, $id)
    {
        $lote = $request->all();
        return $this->loteService->update($lote, $id);
    }

    public function delete(Request $request, $id)
    {
        //TODO ao remover o lote, retirar 1 do lote qtd;
        return $this->loteService->delete($id);
    }
}
