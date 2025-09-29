<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        if(Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => true,
                'name' => $request->user()->name,
                'token' => $request->user()->createToken('TOKEN')->plainTextToken
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Credenciales no correctas'
        ]);
    }
}
