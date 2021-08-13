<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Usuario extends JsonResource
{
    public function __construct(
        $resource,
        private string $token = ''
    )
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $formato = [
            "id" => $this->id,
            "nome_completo" => $this->nome_completo,
            "cpf" => $this->cpf,
            "nascimento" => $this->nascimento,
            "email" => $this->email,
            "telefone" => $this->telefone,
            "reputacao" => $this->reputacao,
            "tipo_usuario" => $this->tipo_usuario,
            "foto_usuario" => $this->foto_usuario,
            "chave_pix" => null,
        ];

        if ($this->token !== '') {
            return $formato + [
                "token" => [
                    "access" => $this->token,
                    "refresh" => $this->token,
                    "token_type" => "bearer",
                    "expires_in" => Auth::factory()->getTTL() * 60
                ]
            ];
        }

        return $formato;
    }
}
