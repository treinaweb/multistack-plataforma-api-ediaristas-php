<?php

namespace App\Services\Pagamento\Provedores;

use App\Services\Pagamento\PagamentoInterface;
use App\Services\Pagamento\TransacaoResponse;
use PagarMe\Client;

class Pagarme implements PagamentoInterface
{
    public function __construct(
        private Client $pagarmeSDK
    ) {
    }

    public function pagar(array $dados): TransacaoResponse
    {
        $transaction = $this->pagarmeSDK->transactions()->create($dados);

        return new TransacaoResponse(
            $transaction->id,
            $transaction->status
        );
    }
}
