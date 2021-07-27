<?php

namespace App\Services\ConsultaCEP;

interface ConsultaCEPInterface
{
    /**
     * Define o padrão para busca de endereço a partir do cep
     *
     * @param string $cep
     * @return void
     */
    public function buscar(string $cep): false|EnderecoResponse;
}