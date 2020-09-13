<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\VendaService;

class VendaController extends Controller
{
    protected $vendaService;

    public function __construct(VendaService $vendaService)
    {
        $this->vendaService = $vendaService;
    }

    public function create(Request $request)
    {
        $venda = $request->all();
        return $this->vendaService->create($venda);
    }
    public function list(Request $request)
    {
        $venda = $request->all();
        return $this->vendaService->list($venda);
    }
    public function update(Request $request, $id)
    {
        $venda = $request->all();
        return $this->vendaService->update($venda, $id);
    }
    public function delete(Request $request, $id)
    {
        return $this->vendaService->delete($id);
    }
}
