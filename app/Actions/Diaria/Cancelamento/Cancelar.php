<?php

namespace App\Actions\Diaria\Cancelamento;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class Cancelar
{
    public function __construct(
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    public function executar(Diaria $diaria, string $motivoCancelamento)
    {
        $this->validaStatusDiaria->executar($diaria, [2, 3]);
        $this->verificaDataAtendimento($diaria->data_atendimento);
        Gate::authorize('dono-diaria', $diaria);

        //$diaria->cancelar($motivoCancelamento);

        $this->penalizacao($diaria);

        dd($diaria);
    }

    private function verificaDataAtendimento(string $dataAtendimento)
    {
        $dataAtendimento = new Carbon($dataAtendimento);
        $agora = Carbon::now();

        if ($agora > $dataAtendimento) {
            throw ValidationException::withMessages([
                'data_atendimento' => 'Não é mais possível cancelar a diária.' .
                    'Entre em contato com nosso suporte'
            ]);
        }
    }

    private function penalizacao(Diaria $diaria)
    {
        $naoTemPenalidade = $this->verificaSeNaoTemPenalizacao($diaria->data_atendimento);
        $tipoUsuario = Auth::user()->tipo_usuario;

        if ($tipoUsuario == '2') {
            //fazer uma ação
        }

        //fazer o reembolso do cliente

        dd($naoTemPenalidade);
    }

    private function verificaSeNaoTemPenalizacao(string $dataAtendimento)
    {
        $dataAtendimento = new Carbon($dataAtendimento);

        $diferencaEmHoras = Carbon::now()->diffInHours($dataAtendimento, false);

        return $diferencaEmHoras > 24;
    }
}
