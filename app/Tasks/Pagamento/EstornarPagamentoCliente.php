<?php

namespace App\Tasks\Pagamento;

use App\Models\Diaria;

class EstornarPagamentoCliente
{
    public function executar(Diaria $diaria)
    {
        dd($diaria);
    }
}
