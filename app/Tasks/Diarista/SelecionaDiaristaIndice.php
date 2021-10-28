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

    /**
     * Retorna o id do(a) melhor candidato(a) para a diária
     *
     * @param Diaria $diaria
     * @return integer
     */
    public function executar(Diaria $diaria): int
    {
        $maiorIndice = 0;

        foreach ($diaria->candidatas as $candidata) {

            try {
                $distancia = $this->consultaDistancia->distanciaEntreDoisCeps(
                    $candidata->candidata->enderecoDiarista->cep,
                    $diaria->cep
                );
            } catch (\Throwable $th) {
                continue;
            }

            $reputacao = $candidata->candidata->reputacao;

            $indiceCandidataAtual = ($reputacao - ($distancia->distanciaEmQuilometros / 10)) / 2;

            if ($indiceCandidataAtual > $maiorIndice) {
                $diaristaEscolhidaId = $candidata->candidata->id;
                $maiorIndice = $indiceCandidataAtual;
            }
        }

        return $diaristaEscolhidaId;
    }
}
