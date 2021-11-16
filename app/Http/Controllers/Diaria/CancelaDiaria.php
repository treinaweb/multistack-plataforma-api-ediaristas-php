<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\Cancelamento\cancelar;
use App\Http\Controllers\Controller;
use App\Models\Diaria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CancelaDiaria extends Controller
{
    public function __construct(
        private cancelar $cancelar
    ) {
        # code...
    }

    /**
     * Realiza o cancelamento de uma diária
     *
     * @param Diaria $diaria
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Diaria $diaria, Request $request): JsonResponse
    {
        $request->validate([
            'motivo_cancelamento' => ['required', 'string']
        ]);

        $this->cancelar->executar($diaria, $request->motivo_cancelamento);

        return resposta_padrao('A diaria foi cancelada com sucesso', 'success', 200);
    }
}
