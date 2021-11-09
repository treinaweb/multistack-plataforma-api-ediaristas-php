<?php

namespace App\Http\Controllers;

use App\Services\Pagamento\PagamentoInterface;
use Illuminate\Http\Request;

class Teste extends Controller
{
    public function __construct(
        private PagamentoInterface $pagamentoServico
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
        $dadosPagamento = [
            'amount' => '4000',
            'card_hash' => '4659098_wo4GEGXFcpBqcxvwPhYT6shg15cu6lSvnW0eB4mdJ4WJDrwIOTeUdeBiXK2CoiSP6NhgUWGPGYF+F4TA/4Dt5ddGw8aHWvUyDFGIiDQg5vsnhJEzP5p+pTyxtCZc1MuawvdO5wAM9RgRdQd3oh2iT1iL0Pqq48mcSV2FWLD6uvS2LuPCNryGSeyWWmZV/KJYx2ga6ztbBK3BQiFHj6XJvT1oRpxEFhYVEQUo6gRlsljRc66TNT7Ny91hiHVPnVMHtvvIQg2yAfMsnExOk+JhWd2061DYZn2UWw1C/B4DXlZkZ6tXKvZcmh7sF15zzXiSMkDx441JDCPRxQuUEL1vew==',
            'async' => false
        ];

        $resposta = $this->pagamentoServico->pagar($dadosPagamento);

        dd($resposta);
    }
}
