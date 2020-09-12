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

    public function create()
    {
    }
    public function list()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
