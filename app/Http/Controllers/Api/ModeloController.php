<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ModeloService;

class ModeloController extends Controller
{
    protected $modeloService;

    public function __construct(ModeloService $modeloService)
    {
        $this->modeloService = $modeloService;
    }

    public function create(Request $request)
    {
        $modelo = $request->all();
        return $this->modeloService->create($modelo);
    }
    public function list(Request $request)
    {
        $modelo = $request->all();
        return $this->modeloService->list($modelo);
    }
    public function update(Request $request, $id)
    {
        $modelo = $request->all();
        return $this->modeloService->update($modelo, $id);
    }
    public function delete(Request $request, $id)
    {
        return $this->modeloService->delete($id);
    }
}
