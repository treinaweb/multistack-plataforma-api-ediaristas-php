<?php

namespace App\Tasks\Pagamento;

use App\Models\Diaria;
use App\Services\Pagamento\TransacaoResponse;
use App\Services\Pagamento\PagamentoInterface;
use Illuminate\Validation\ValidationException;

class EstornarPagamentoCliente
{
    public function __construct(
        private PagamentoInterface $pagamento
    ) {
    }

    /**
     * Realiza o estorno no gateway de pagamento
     *
     * @param Diaria $diaria
     * @return void
     */
    public function executar(Diaria $diaria): void
    {
        $pagamento = $diaria->pagamentoValido();

        $transacao = $this->realizaEstornoGateway($pagamento->transacao_id);
        $this->guardaTransacaoBancoDeDados($diaria, $pagamento->transacao_id);

        $this->validaStatusEstorno($transacao);
    }

    /**
     * Chama o serviço para realizar o estorno no gateway
     *
     * @param integer $transacaoId
     * @return TransacaoResponse
     */
    private function realizaEstornoGateway(int $transacaoId): TransacaoResponse
    {
        try {
            $transacao = $this->pagamento->estornar([
                'id' => $transacaoId
            ]);
        } catch (\Throwable $exception) {
            throw ValidationException::withMessages([
                'pagamento' => $exception->getMessage()
            ]);
        }

        return $transacao;
    }

    /**
     * Guarda a transação no banco de dados local
     *
     * @param Diaria $diaria
     * @param integer $transacaoId
     * @return void
     */
    private function guardaTransacaoBancoDeDados(Diaria $diaria, int $transacaoId): void
    {
        $diaria->pagamentos()->create([
            'status' => 'estornado',
            'transacao_id' => $transacaoId,
            'valor' => $diaria->preco
        ]);
    }

    /**
     * Valida se o status da trasanção está correto para o estorno
     *
     * @param TransacaoResponse $transacao
     * @return void
     */
    public function validaStatusEstorno(TransacaoResponse $transacao): void
    {
        if ($transacao->status !== 'refunded') {
            throw ValidationException::withMessages([
                'pagamento' => 'Não foi possível extornar o pagamento'
            ]);
        }
    }
}
