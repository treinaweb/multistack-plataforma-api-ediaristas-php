<?php

namespace App\Actions\Diarista;

use App\Models\Endereco;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ObterEndereco
{
    /**
     * Obtem o endereço do(a) diarista
     *
     * @return Endereco
     */
    public function executar(): Endereco
    {
        Gate::authorize('tipo-diarista');

        $diarista = Auth::user();

        return $diarista->enderecoDiarista()->first();
    }
}
