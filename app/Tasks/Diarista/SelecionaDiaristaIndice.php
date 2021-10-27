<?php

namespace App\Tasks\Diarista;

use App\Models\Diaria;
use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;

class SelecionaDiaristaIndice
{
    public function __construct(
        private ConsultaDistanciaInterface $consultaDistancia
    ) {
    }

    public function executar(Diaria $diaria): int
    {
        foreach ($diaria->candidatas as $candidata) {

            //a distancia entre a casa do candidato e a casa do cliente
            $distancia = $this->consultaDistancia->distanciaEntreDoisCeps(
                $candidata->candidata->enderecoDiarista->cep,
                $diaria->cep
            );

            var_dump($distancia);

            //a reputação do candidato

            //fazer o calculo do indice do melhor candidato
        }

        dd('depois do loop');

        return 1;
    }
}
