<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\PagarDiaria;
use App\Http\Controllers\Controller;
use App\Models\Diaria;
use Illuminate\Http\Request;

class PagaDiaria extends Controller
{
    public function __construct(
        private PagarDiaria $pagarDiaria
    ){}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Diaria $diaria)
    {
        $request->validate(['card_hash' => 'required']);

        $this->pagarDiaria->executar($diaria, $request->card_hash);

        return resposta_padrao('Diária paga com sucesso', 'success', 200);
    }
}
