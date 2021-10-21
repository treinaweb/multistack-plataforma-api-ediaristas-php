<?php

namespace App\Http\Controllers\Diaria;

use App\Models\Diaria;
use App\Http\Controllers\Controller;
use App\Actions\Diaria\EscolheDiarista\CandidatarDiarista;
use Illuminate\Http\JsonResponse;

class CandidataDiarista extends Controller
{
    public function __construct(
        private CandidatarDiarista $candidatarDiarista
    ) {
    }

    /**
     * Candidata um(a) diarista para reliazar uma diária
     *
     * @param Diaria $diaria
     * @return JsonResponse
     */
    public function __invoke(Diaria $diaria): JsonResponse
    {
        $this->candidatarDiarista->executar($diaria);

        return resposta_padrao('Ação executada com sucesso', 'success', 200);
    }
}
