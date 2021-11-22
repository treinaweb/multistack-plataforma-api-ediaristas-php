<?php

namespace App\Actions\Usuario;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AtualizarUsuario
{
    public function executar(array $dados)
    {
        if (isset($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        }

        $user = Auth::user();

        $user->update($dados);
    }
}
