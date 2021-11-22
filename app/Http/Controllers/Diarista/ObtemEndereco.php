<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObterEndereco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObtemEndereco extends Controller
{
    public function __construct(
        private ObterEndereco $obterEndereco
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $endereco = $this->obterEndereco->executar();

        return response($endereco, 200);
    }
}
