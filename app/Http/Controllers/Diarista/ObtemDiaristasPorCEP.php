<?php

namespace App\Http\Controllers\Diarista;

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
     * @param ConsultaCEPInterface $servicoCEP
     * @return DiariaristaPublicoCollection|JsonResponse
     */
    public function __invoke(Request $request, ConsultaCEPInterface $servicoCEP): DiariaristaPublicoCollection|JsonResponse
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        $dados = $servicoCEP->buscar($request->cep);

        if ($dados === false) {
            return response()->json(['erro' => 'CEP Inválido'], 400);
        }

        return new DiariaristaPublicoCollection(
            User::diaristasDisponivelCidade($dados->ibge),
            User::diaristasDisponivelCidadeTotal($dados->ibge)
        );
    }
}
