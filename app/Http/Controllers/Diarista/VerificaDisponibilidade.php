<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificaDisponibilidade extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ObterDiaristasPorCEP $action)
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        [$diaristasCollection] = $action->executar($request->cep);

        return resposta_padrao(
            "Disponibilidade verificada com sucesso",
            "success",
            200,
            ["disponibilidade" => $diaristasCollection->isNotEmpty()]
        );

    }
}
