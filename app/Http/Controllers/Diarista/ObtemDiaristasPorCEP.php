<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiariaristaPublicoCollection;
use App\Http\Resources\DiaristaPublico;
use App\Models\User;
use App\Services\ConsultaCEP\ViaCEP;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ViaCEP $servicoCEP)
    {
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
