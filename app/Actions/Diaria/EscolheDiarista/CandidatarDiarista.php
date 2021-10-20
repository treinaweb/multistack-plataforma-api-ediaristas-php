<?php

namespace App\Actions\Diaria\EscolheDiarista;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CandidatarDiarista
{
    public function __construct(
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    public function executar(Diaria $diaria)
    {
        $this->validaStatusDiaria->executar($diaria, 2);

        $diaria->candidatas()->create([
            'diarista_id' => Auth::user()->id
        ]);

        dd('depois da gravação');
    }
}
