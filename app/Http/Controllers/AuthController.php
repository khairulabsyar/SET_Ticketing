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

        $role = "";
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user->hasRole('Admin')) {
            $role = "Admin";
        } elseif ($user->hasRole("Developer")) {
            $role = "Developer";
        } else {
            $role = "Client";
        }

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Success Login',
                'data' => [
                    'token' => $token,
                    'firstName' => $user->first_name,
                    'role' => $role,
                    "id" => $user->id,
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