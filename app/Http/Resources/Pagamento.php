<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pagamento extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "status" => $this->status == 7 ? 1 : 2,

            "valor_deposito" => $this->preco - $this->valor_comissao,
            "valor" => $this->preco,

            "created_at" => $this->created_at
        ];
    }
}
