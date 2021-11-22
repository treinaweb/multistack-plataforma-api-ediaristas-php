<?php

namespace App\Actions\Diarista;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ObterEndereco
{
    public function executar()
    {
        Gate::authorize('tipo-diarista');

        $diarista = Auth::user();

        return $diarista->enderecoDiarista()->first();
    }
}
