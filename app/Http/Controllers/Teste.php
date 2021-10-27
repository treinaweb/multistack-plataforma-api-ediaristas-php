<?php

namespace App\Http\Controllers;

use App\Models\Diaria;
use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;
use App\Services\ConsultaDistancia\Provedores\GoogleMatrix;
use App\Tasks\Diarista\SelecionaDiaristaIndice;
use Illuminate\Http\Request;


class Teste extends Controller
{
    public function __invoke(SelecionaDiaristaIndice $selecionaDiarista)
    {
        $diaria = Diaria::find(68);

        $diaristaEscolhidoId = $selecionaDiarista->executar($diaria);

        dd($diaristaEscolhidoId);
    }
}
