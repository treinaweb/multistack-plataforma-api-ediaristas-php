<?php

namespace App\Actions\Usuario;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class DefinirFotoPerfil
{
    public function executar(UploadedFile $fotoUsuario)
    {
        $usuario = Auth::user();

        $usuario->foto_usuario = $fotoUsuario->store('public');

        return $usuario->update();
    }
}
