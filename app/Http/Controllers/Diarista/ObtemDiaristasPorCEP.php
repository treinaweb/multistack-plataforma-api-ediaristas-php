<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Http\Resources\DiariaristaPublicoCollection;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Busca diaristas pelo CEP
     *
     * @param Request $request
     * @return DiariaristaPublicoCollection|JsonResponse
     */
    public function __invoke(Request $request, ObterDiaristasPorCEP $action): DiariaristaPublicoCollection|JsonResponse
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        [$diaristasCollection, $quantidadeDiaristas] = $action->executar($request->cep);

        return new DiariaristaPublicoCollection(
            $diaristasCollection,
            $quantidadeDiaristas
        );
    }
}
