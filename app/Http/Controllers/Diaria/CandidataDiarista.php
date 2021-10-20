<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\EscolheDiarista\CandidatarDiarista;
use App\Http\Controllers\Controller;
use App\Models\Diaria;
use Illuminate\Http\Request;

class CandidataDiarista extends Controller
{
    public function __construct(
        private CandidatarDiarista $candidatarDiarista
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Diaria $diaria)
    {
        $this->candidatarDiarista->executar($diaria);
    }
}
