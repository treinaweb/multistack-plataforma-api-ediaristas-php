<?php

namespace App\Http\Hateoas;

class Index 
{
    /**
     * Links do hateoas
     */
    protected array $links = [];

    /**
     * Retonar o links do hateoas para a rota inicial
     *
     * @return array
     */
    public function links(): array
    {
        $this->adicionaLink("GET", "diaristas_cidade", 'diaristas.buca_por_cep');
        $this->adicionaLink("GET", "verificar_disponibilidade_atendimento", 'enderecos.disponibilidade');
        $this->adicionaLink("GET", "endereco_cep", 'enderecos.cep');
        $this->adicionaLink("GET", "listar_servicos", 'servicos.index');

        return $this->links;
    }

    /**
     * Adiciona um link no hateoas
     *
     * @param string $metodo
     * @param string $descricao
     * @param string $nomeRota
     * @param array $parametrosRota
     * @return void
     */
    protected function adicionaLink(
        string $metodo, 
        string $descricao, 
        string $nomeRota, 
        array $parametrosRota = []
    ) {
        $this->links[] = [
            "type" => $metodo,
            "rel" => $descricao,
            "uri" => route($nomeRota, $parametrosRota)
        ];
    }
}