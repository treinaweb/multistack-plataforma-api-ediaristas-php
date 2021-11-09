<?php

namespace App\Actions\Diaria;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use App\Services\Pagamento\PagamentoInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PagarDiaria
{
    public function __construct(
        private ValidaStatusDiaria $validaStatusDiaria,
        private PagamentoInterface $pagamento
    ) {
    }

    /**
     * Executa o pagamento da diária
     *
     * @param Diaria $diaria
     * @param string $cardHash
     * @return boolean
     */
    public function executar(Diaria $diaria, string $cardHash): bool
    {
        $this->validaStatusDiaria->executar($diaria, 1);
        Gate::authorize('tipo-cliente');
        Gate::authorize('dono-diaria', $diaria);

        //integração com gateway de pagamento
        $transacao = $this->pagamento->pagar([
            'amount' => intval($diaria->preco * 100),
            'card_hash' => $cardHash,
            'async' => false
        ]);

        $diaria->pagamentos()->create([
            'status' => $transacao->status === 'paid' ? 'pago' : 'reprovado',
            'transacao_id' => $transacao->transacaoId,
            'valor' => $diaria->preco
        ]);

        if ($transacao->status !== 'paid') {
            throw ValidationException::withMessages([
                'pagamento' => 'Pagamento Reprovado'
            ]);
        }

        return $diaria->pagar();
    }
}
