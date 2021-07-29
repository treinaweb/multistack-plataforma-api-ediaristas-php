<?php

namespace App\Http\Controllers\Diarista;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Diarista\ObterDiaristasPorCEP;
use App\Http\Resources\DiariaristaPublicoCollection;

class ObtemDiaristasPorCEP extends Controller
{
    public function __construct(
        private ObterDiaristasPorCEP $obterDiaristasPorCEP
    ){}

    /**
     * Busca diaristas pelo CEP
     *
     * @param Request $request
     * @return DiariaristaPublicoCollection|JsonResponse
     */
    public function __invoke(Request $request): DiariaristaPublicoCollection|JsonResponse
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
