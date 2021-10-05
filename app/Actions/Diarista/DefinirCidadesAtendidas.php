<?php

namespace App\Actions\Diarista;

use App\Models\Cidade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DefinirCidadesAtendidas
{
    public function executar(array $cidades)
    {
        Gate::authorize('tipo-diarista');

        $cidadesIds = [];

        foreach ($cidades as $cidade) {
            //validar o código do ibge na api

            $cidadeModel = Cidade::firstOrCreate(
                ['codigo_ibge' => $cidade['codigo_ibge']],
                [
                    'cidade' => $cidade['cidade'],
                    'codigo_ibge' => $cidade['codigo_ibge'],
                    'estado' => 'XX'
                ]
            );

            $cidadesIds[] = $cidadeModel->id;
        }

        $diarista = Auth::user();

        $diarista->cidadesAtendidas()->sync($cidadesIds);
    }
}
