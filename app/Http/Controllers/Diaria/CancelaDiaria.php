<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\Cancelamento\cancelar;
use App\Http\Controllers\Controller;
use App\Models\Diaria;
use Illuminate\Http\Request;

class CancelaDiaria extends Controller
{
    public function __construct(
        private cancelar $cancelar
    ) {
        # code...
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Diaria $diaria)
    {
        $this->cancelar->executar($diaria);
    }
}
