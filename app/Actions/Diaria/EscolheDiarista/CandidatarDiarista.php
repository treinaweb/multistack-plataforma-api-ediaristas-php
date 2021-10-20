<?php

namespace App\Actions\Diaria\EscolheDiarista;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class CandidatarDiarista
{
    public function __construct(
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    public function executar(Diaria $diaria)
    {
        Gate::authorize('tipo-diarista');
        $this->validaStatusDiaria->executar($diaria, 2);
        $this->verificaDuplicidadeDeCandidato($diaria);

        $diaria->candidatas()->create([
            'diarista_id' => Auth::user()->id
        ]);

        dd('depois da gravação');
    }

    private function verificaDuplicidadeDeCandidato(Diaria $diaria)
    {
        $diaristaCandidato = $diaria->candidatas()
            ->where('diarista_id', Auth::user()->id)
            ->first();

        if ($diaristaCandidato) {
            throw ValidationException::withMessages([
                'data_criacao' => 'O/A diarista já é candidato(a) dessa diária'
            ]);
        }
    }
}
