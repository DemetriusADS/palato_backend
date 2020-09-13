<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PicoleService;

class PicoleController extends Controller
{
    protected $picoleService;

    public function __construct(PicoleService $picoleService)
    {
        $this->picoleService = $picoleService;
    }

    public function create(Request $request)
    {
        $picole = $request->all();
        return $this->picoleService->create($picole);
    }
    public function list(Request $request)
    {
        $picole = $request->all();
        return $this->picoleService->list($picole);
    }
    public function update(Request $request, $id)
    {
        $filters = $request->all();
        return $this->picoleService->update($filters, $id);
    }
    public function delete(Request $request, $id)
    {
        return $this->picoleService->delete($id);
    }
}
