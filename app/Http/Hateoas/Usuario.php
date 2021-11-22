<?php

namespace App\Http\Hateoas;

use Illuminate\Database\Eloquent\Model;

class Usuario extends HateoasBase implements HateoasInterface
{
    /**
     * Retorna os links do Hateoas para o usuário
     *
     * @param Model|null $usuario
     * @return array
     */
    public function links(?Model $usuario): array
    {
        $this->adicionaLink('GET', 'lista_diarias', 'diarias.index');
        $this->adicionaLink('PUT', 'editar_usuario', 'usuarios.update');
        $this->adicionaLink('POST', 'alterar_foto_usuario', 'usuarios.definir-foto');

        $this->linksDoCliente($usuario);
        $this->linksDoDiarista($usuario);

        return $this->links;
    }

    /**
     * Adiciona os links especificos do usuário do tipo cliente
     *
     * @param Model $usuario
     * @return void
     */
    private function linksDoCliente(Model $usuario): void
    {
        if ($usuario->tipo_usuario === 1) {
            $this->adicionaLink('POST', 'cadastrar_diaria', 'diarias.store');
        }
    }

    /**
     * adiciona os links especificos do usuário do tipo diarista
     *
     * @param Model $usuario
     * @return void
     */
    private function linksDoDiarista(Model $usuario): void
    {
        if ($usuario->tipo_usuario === 2) {
            $this->adicionaLink('PUT', 'cadastrar_endereco', 'usuarios.definir-endereco');
            $this->adicionaLink('PUT', 'editar_endereco', 'usuarios.definir-endereco');
            $this->adicionaLink('GET', 'listar_endereco', 'usuarios.obter-endereco');
            $this->adicionaLink('PUT', 'relacionar_cidades', 'usuarios.definir-cidades');
            $this->adicionaLink('GET', 'lista_oportunidades', 'oportunidades.index');
            $this->adicionaLink('GET', 'lista_pagamentos', 'pagamentos.index');
            $this->adicionaLink('GET', 'cidades_atendidas', 'usuarios.obter-cidades');
        }
    }
}
