<?php

namespace App\Services\ConsultaDistancia\Provedores;

use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;
use App\Services\ConsultaDistancia\DistanciaResponse;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;
use TeamPickr\DistanceMatrix\Frameworks\Laravel\DistanceMatrix;

class GoogleMatrix implements ConsultaDistanciaInterface
{
    public function __construct(
        private StandardLicense $license
    ) {
    }

    public function distanciaEntreDoisCeps(string $origem, string $destino): DistanciaResponse
    {
        $response = DistanceMatrix::license($this->license)
            ->addOrigin($this->formataCep($origem))
            ->addDestination($this->formataCep($destino))
            ->request();

        return new DistanciaResponse(
            $response->json['rows'][0]['elements'][0]['distance']['value'] / 1000
        );
    }

    /**
     * Valida e formata o cep
     *
     * @param string $cep
     * @return string
     */
    private function formataCep(string $cep): string
    {
        $this->verificaPadraoCep($cep);

        return substr_replace($cep, '-', 5, 0);
    }

    /**
     * Verifica o tamanho e padrão do cep
     *
     * @param string $cep
     * @return void
     */
    private function verificaPadraoCep(string $cep): void
    {
        if (strlen($cep) !== 8) {
            throw new \Exception("O cep deve ter 8 digitos", 1);
        }

        if (!preg_match('/^[0-9]+$/', $cep)) {
            throw new \Exception("O cep deve ter apenas números", 1);
        }
    }
}
