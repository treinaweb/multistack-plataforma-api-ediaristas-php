<?php

namespace App\Actions\Diarista;

use App\Models\Cidade;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DefinirCidadesAtendidas
{
    public function __construct(
        private ConsultaCidadeInterface $consultaCidade
    ) {
    }

    public function executar(array $cidades)
    {
        Gate::authorize('tipo-diarista');

        $cidadesIds = [];

        foreach ($cidades as $cidade) {
            $cidadeValida = $this->consultaCidade->codigoIBGE($cidade['codigo_ibge']);

            $cidadeModel = Cidade::firstOrCreate(
                ['codigo_ibge' => $cidade['codigo_ibge']],
                [
                    'cidade' => $cidadeValida->nome,
                    'codigo_ibge' => $cidade['codigo_ibge'],
                    'estado' => $cidadeValida->estado
                ]
            );

            $cidadesIds[] = $cidadeModel->id;
        }

        $diarista = Auth::user();

        $diarista->cidadesAtendidas()->sync($cidadesIds);
    }
}
