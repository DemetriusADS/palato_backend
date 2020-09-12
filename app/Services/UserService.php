<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\User;

class UserService
{
    public function create($userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        $newUser = User::create($userData);
        $newUser->syncRoles($userData['permission']);
        if ($newUser) {
            return response()->json($newUser, 200);
        }
        return response("", 400);
    }
    public function list($filter = [])
    {
        if (empty($filter)) {
            return response()->json(User::all());
        }
    }
    public function update($data, $id)
    {
        $user = User::find($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        if (isset($data['permission'])) {
            $user->syncRoles($data['permission']);
        }
        $isUpdated = $user->update($data);
        return $isUpdated ? response()->json($user, 200) : response("", 500);
    }
    public function delete($id)
    {
        $user = User::find($id);
        $delete = $user->delete();
        return $delete ? response("", 200) : response("", 500);
    }
}
