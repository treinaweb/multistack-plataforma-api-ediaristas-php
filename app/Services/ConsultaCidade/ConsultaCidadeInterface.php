<?php

namespace App\Services\ConsultaCidade;

interface ConsultaCidadeInterface
{
    /**
     * Busca um código do IBGE na API
     *
     * @param integer $codigo
     * @return CidadeResponse
     */
    public function codigoIBGE(int $codigo): CidadeResponse;
}
