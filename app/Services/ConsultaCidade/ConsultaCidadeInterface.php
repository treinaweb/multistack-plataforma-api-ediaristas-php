<?php

namespace App\Services\ConsultaCidade;

interface ConsultaCidadeInterface
{
    public function codigoIBGE(int $codigo): CidadeResponse;
}
