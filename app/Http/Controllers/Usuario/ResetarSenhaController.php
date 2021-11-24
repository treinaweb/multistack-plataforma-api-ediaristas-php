<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetarSenhaController extends Controller
{
    public function solicitarToken(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        Password::sendResetLink(
            $request->only('email')
        );

        return resposta_padrao(
            'Verifique na sua caixa de entrada ou de spam a mensagem',
            'success',
            200
        );
    }
}
