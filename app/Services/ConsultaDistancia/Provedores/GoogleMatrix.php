<?php

namespace App\Services\ConsultaDistancia\Provedores;

use TeamPickr\DistanceMatrix\Licenses\StandardLicense;
use TeamPickr\DistanceMatrix\Frameworks\Laravel\DistanceMatrix;

class GoogleMatrix
{
    public function distanciaEntreDoisCeps(string $origem, string $destino)
    {
        $license = new StandardLicense(config('google.key'));

        return DistanceMatrix::license($license)
            ->addOrigin($this->formataCep($origem))
            ->addDestination($this->formataCep($destino))
            ->request();
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
