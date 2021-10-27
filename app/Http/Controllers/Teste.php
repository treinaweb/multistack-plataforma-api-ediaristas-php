<?php

namespace App\Http\Controllers;

use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;
use App\Services\ConsultaDistancia\Provedores\GoogleMatrix;
use Illuminate\Http\Request;


class Teste extends Controller
{
    public function __construct(
        private ConsultaDistanciaInterface $consultaDistancia
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $response = $this->consultaDistancia->distanciaEntreDoisCeps('09715340', '02221000');

        dd($response);
    }
}
