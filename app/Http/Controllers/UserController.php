<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;   // <—
use App\Models\User;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        // 60 saniye cache; prod’da 300–600 sn gibi düşünebilirsin
        return Cache::remember('users_all', 60, function () {
            return User::select('id','name','email','created_at')
                ->orderByDesc('id')->get();
        });
    }

    // POST /api/users
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($data);
        Cache::forget('users_all'); // invalidate
        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::select('id','name','email','created_at')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name'  => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($data);
        Cache::forget('users_all'); // invalidate
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Cache::forget('users_all'); // invalidate
        return response()->json(['deleted' => true]);
    }
}
