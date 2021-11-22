<?php

namespace App\Http\Controllers\Usuario;

use App\Actions\Usuario\DefinirFotoPerfil;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DefineFotoPerfil extends Controller
{
    public function __construct(
        private DefinirFotoPerfil $definirFotoPerfil
    ) {
    }

    /**
     * Define a foto do usuário
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'foto_usuario' => ['required', 'image']
        ]);

        $this->definirFotoPerfil->executar($request->foto_usuario);

        return resposta_padrao('Foto do usuário definida com sucesso', 'success', 200);
    }
}
