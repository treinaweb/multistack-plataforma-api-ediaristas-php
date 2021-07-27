<?php

namespace App\Services\ConsultaCEP;

use Illuminate\Support\Facades\Http;

class ViaCEP 
{
    /**
     * Buscar endereço utizando a api do viaCEP
     *
     * @param string $cep
     * @return void
     */
    public function buscar(string $cep)
    {
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json/");

        return $resposta->json();
    }
}