<?php

namespace App\Actions\Diaria\EscolheDiarista;

use App\Models\Diaria;
use App\Tasks\Diarista\SelecionaDiaristaIndice;

class SelecionaAutomaticamente
{
    public function __construct(
        private SelecionaDiaristaIndice $selecionaDiaristaIndice
    ) {
    }

    public function executar()
    {
        $diarias = Diaria::pagasComMaisDe24Horas();

        foreach ($diarias as $diaria) {

            if ($diaria->candidatas_count === 1) {
                $diaria->confirmar($diaria->candidatas[0]->diarista_id);
            }

            if ($diaria->candidatas_count > 1) {
                $diaria->confirmar(
                    $this->selecionaDiaristaIndice->executar($diaria)
                );
            }
        }
    }
}
