<?php

namespace App\Actions\Diarista;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ObterCidadesAtendidas
{
    public function executar()
    {
        Gate::authorize('tipo-diarista');

        $diarista = Auth::user();

        return $diarista->cidadesAtendidas()->get();
    }
}
