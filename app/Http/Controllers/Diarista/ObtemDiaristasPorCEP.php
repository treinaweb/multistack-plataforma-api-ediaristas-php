<?php

namespace App\Http\Controllers\Diarista;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Http\Resources\DiariaristaPublicoCollection;
use Illuminate\Validation\ValidationException;

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
            throw ValidationException::withMessages(['cep' => 'Cep não encontrado']);
        }

        return new DiariaristaPublicoCollection(
            User::diaristasDisponivelCidade($dados->ibge),
            User::diaristasDisponivelCidadeTotal($dados->ibge)
        );
    }
}
