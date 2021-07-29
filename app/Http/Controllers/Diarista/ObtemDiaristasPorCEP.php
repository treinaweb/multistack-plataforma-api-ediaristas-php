<?php

namespace App\Http\Controllers\Diarista;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Requests\CepRequest;
use App\Http\Resources\DiariaristaPublicoCollection;

class ObtemDiaristasPorCEP extends Controller
{
    public function __construct(
        private ObterDiaristasPorCEP $obterDiaristasPorCEP
    ){}

    /**
     * Busca diaristas pelo CEP
     *
     * @param CepRequest $request
     * @return DiariaristaPublicoCollection|JsonResponse
     */
    public function __invoke(CepRequest $request): DiariaristaPublicoCollection|JsonResponse
    {
        $request->validate([
            'cep' => ['required', 'numeric']
        ]);

        [$diaristasCollection, $quantidadeDiaristas] = $this->obterDiaristasPorCEP->executar($request->cep);

        return new DiariaristaPublicoCollection(
            $diaristasCollection,
            $quantidadeDiaristas
        );
    }
}
