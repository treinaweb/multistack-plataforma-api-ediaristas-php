<?php

namespace App\Actions\Diaria\Cancelamento;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class cancelar
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

        $diaria->cancelar($motivoCancelamento);

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
}
