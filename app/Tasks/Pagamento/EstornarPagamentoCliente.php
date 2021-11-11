<?php

namespace App\Tasks\Pagamento;

use App\Models\Diaria;
use App\Services\Pagamento\PagamentoInterface;
use Illuminate\Validation\ValidationException;

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

        $diaria->pagamentos()->create([
            'status' => 'estornado',
            'transacao_id' => $pagamento->transacao_id,
            'valor' => $diaria->preco
        ]);

        if ($transacao->status !== 'refunded') {
            throw ValidationException::withMessages([
                'pagamento' => 'Não foi possível extornar o pagamento'
            ]);
        }
    }
}
