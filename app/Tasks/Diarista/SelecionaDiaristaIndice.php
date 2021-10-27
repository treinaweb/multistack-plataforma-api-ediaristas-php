<?php

namespace App\Tasks\Diarista;

use App\Models\Diaria;

class SelecionaDiaristaIndice
{
    public function executar(Diaria $diaria): int
    {
        foreach ($diaria->candidatas as $candidata) {
            var_dump($candidata->candidata);

            //a distancia entre a casa do candidato e a casa do cliente

            //a reputação do candidato

            //fazer o calculo do indice do melhor candidato
        }

        return 1;
    }
}
