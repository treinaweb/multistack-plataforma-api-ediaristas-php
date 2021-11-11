<?php

namespace App\Tasks\Pagamento;

use App\Models\Diaria;
use App\Services\Pagamento\PagamentoInterface;

class EstornarPagamentoCliente
{
    public function __construct(
        private PagamentoInterface $pagamento
    ) {
        # code...
    }

    public function executar(Diaria $diaria)
    {
        $pagamento = $diaria->pagamentos()->where('status', 'pago')->first();

        $transacao = $this->pagamento->estornar([
            'id' => $pagamento->transacao_id
        ]);

        dd($transacao);
    }
}
