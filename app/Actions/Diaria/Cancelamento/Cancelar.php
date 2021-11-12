<?php

namespace App\Actions\Diaria\Cancelamento;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;

class cancelar
{
    public function __construct(
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    public function executar(Diaria $diaria)
    {
        $this->validaStatusDiaria->executar($diaria, [1, 2, 3, 6]);

        dd($diaria);
    }
}
