<?php

namespace App\Actions\Diaria\Cancelamento;

use App\Models\Diaria;

class cancelar
{
    public function executar(Diaria $diaria)
    {
        dd($diaria);
    }
}
