<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $links = [
            [
                "type" => "GET",
                "rel" => "diaristas_cidade",
                "uri" => route('diaristas.buca_por_cep')
            ],
            [
                "type" => "GET",
                "rel" => "verificar_disponibilidade_atendimento",
                "uri" => route('enderecos.disponibilidade')
            ],
            [
                "type" => "GET",
                "rel" => "endereco_cep",
                "uri" => route('enderecos.cep')
            ],
            [
                "type" => "GET",
                "rel" => "listar_servicos",
                "uri" => route('servicos.index')
            ]
        ];

        return response()->json([
            'links' => $links
        ]);
    }
}
