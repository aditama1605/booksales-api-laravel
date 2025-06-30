<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // GET: /api/users
    public function index()
    {
        return response()->json(User::all());
    }

    // POST: /api/users
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'in:admin,user'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'user'
        ]);

        return response()->json(['message' => 'User created', 'data' => $user]);
    }

    // GET: /api/users/{id}
    public function show($id)
    {
        $user = User::find($id);
        return $user ? response()->json($user) : response()->json(['message' => 'User not found'], 404);
    }

    // PUT: /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $validator = Validator::make($request->all(), [
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role'     => 'in:admin,user'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update([
            'name'     => $request->name ?? $user->name,
            'email'    => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role'     => $request->role ?? $user->role
        ]);

        return response()->json(['message' => 'User updated', 'data' => $user]);
    }

    // DELETE: /api/users/{id}
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
