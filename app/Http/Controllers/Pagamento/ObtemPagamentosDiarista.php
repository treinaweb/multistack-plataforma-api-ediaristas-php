<?php

namespace App\Http\Controllers\Pagamento;

use App\Actions\Pagamento\ObterPagamentosDiarista;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObtemPagamentosDiarista extends Controller
{
    public function __construct(
        private ObterPagamentosDiarista $obterPagamentosDiarista
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
        $this->obterPagamentosDiarista->executar();
    }
}
