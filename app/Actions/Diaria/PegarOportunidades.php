<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use Illuminate\Support\Facades\Auth;

class PegarOportunidades
{
    public function executar()
    {
        $diarista = Auth::user();

        return Diaria::oportunidadesPorCidade($diarista);
    }
}
