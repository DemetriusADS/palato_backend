<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $newUserData = $request->only(['name', 'email', 'password', 'type_id', 'permission']);
        return $this->userService->create($newUserData);
    }

    public function list(Request $request)
    {
        $filters = $request->only(['filters']);
        return $this->userService->list($filters);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->userService->update($data, $id);
    }

    public function delete(Request $request, $id)
    {
        return $this->userService->delete($id);
    }
}
