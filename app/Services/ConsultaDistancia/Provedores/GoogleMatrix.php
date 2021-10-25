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
            ->addOrigin($origem)
            ->addDestination($destino)
            ->request();
    }
}
