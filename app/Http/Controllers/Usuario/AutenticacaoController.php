<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacaoController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credenciais)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return resposta_token($token);
    }

    public function me()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => "Successfully logged out"
        ]);
    }

    public function refresh()
    {
        return resposta_token(Auth::refresh());
    }
}
