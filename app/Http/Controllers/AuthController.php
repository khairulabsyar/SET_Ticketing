<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|min:5',
            'password' => 'required|string',
        ]);

        $user = User::where('first_name', $data['first_name'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Success Login',
                'data' => [
                    'token' => $token
                ]
            ]);
        }

        abort(404, 'User is not registered');
    }

    public function logout()
    {
        Auth::user()->tokens->last()->delete();

        return 'Success logout';
    }
}