<?php

namespace App\Actions\Diaria\EscolheDiarista;

use App\Models\Diaria;
use App\Tasks\Diarista\SelecionaDiaristaIndice;
use Carbon\Carbon;

class SelecionaAutomaticamente
{
    public function __construct(
        private SelecionaDiaristaIndice $selecionaDiaristaIndice
    ) {
    }

    public function executar()
    {
        $diarias = Diaria::where('status', 2)
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->withCount('candidatas')
            ->get();

        foreach ($diarias as $diaria) {

            if ($diaria->candidatas_count === 1) {
                $diaria->confirmar($diaria->candidatas[0]->diarista_id);
                continue;
            }

            if ($diaria->candidatas_count > 1) {
                $diaria->confirmar(
                    $this->selecionaDiaristaIndice->executar($diaria)
                );
            }
        }
    }
}
