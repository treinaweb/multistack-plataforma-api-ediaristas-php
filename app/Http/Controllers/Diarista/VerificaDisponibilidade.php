<?php

namespace App\Http\Controllers\Diarista;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diarista\ObterDiaristasPorCEP;

class VerificaDisponibilidade extends Controller
{
    public function __construct(
        private ObterDiaristasPorCEP $obterDiaristasPorCEP
    ){}

    /**
     * Retorna a disponibilidade de diaristas para um CEP
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        [$diaristasCollection] = $this->obterDiaristasPorCEP->executar($request->cep);

        return resposta_padrao(
            "Disponibilidade verificada com sucesso",
            "success",
            200,
            ["disponibilidade" => $diaristasCollection->isNotEmpty()]
        );

    }
}
