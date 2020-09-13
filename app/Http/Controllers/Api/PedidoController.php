<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PedidoService;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function create(Request $request)
    {
        $pedidos = $request->all();
        return $this->pedidoService->create($pedidos);
    }
    public function list(Request $request)
    {
        $pedido = $request->all();
        return $this->pedidoService->list($pedido);
    }
    public function update(Request $request, $id)
    {
        $pedido = $request->all();
        return $this->pedidoService->update($pedido, $id);
    }
    public function delete(Request $request, $id)
    {
        return $this->pedidoService->delete($id);
    }
}
