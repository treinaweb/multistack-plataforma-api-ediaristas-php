<?php

namespace App\Services\ConsultaCidade;

class CidadeResponse
{
    public function __construct(
        public int $codigoIbge,
        public string $nome,
        public string $estado
    ) {
    }
}
