<?php

namespace App\Actions\Diaria;

use App\Checkers\Diaria\ValidaStatusDiaria;
use App\Models\Diaria;
use App\Tasks\Usuario\AtualizaReputacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\This;

class AvaliarDiaria
{
    public function __construct(
        private AtualizaReputacao $atualizaReputacao,
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    public function executar(Diaria $diaria, array $dadosAvaliacao)
    {
        Gate::authorize('dono-diaria', $diaria);
        $this->validaStatusDiaria->executar($diaria, 4);

        $this->criaAvaliacao($diaria, $dadosAvaliacao);

        $this->atualizaReputacao->executar(
            $this->obtemUsuarioAvaliadoID($diaria)
        );

        dd('cheguei na action', $diaria, $dadosAvaliacao);
    }


    private function criaAvaliacao(Diaria $diaria, array $dadosAvaliacao)
    {
        return $diaria->avaliacoes()->create(
            $dadosAvaliacao + [
                'visibilidade' => 1,
                'avaliador_id' => Auth::user()->id,
                'avaliado_id' => $this->obtemUsuarioAvaliadoID($diaria)
            ]
        );
    }

    /**
     * Retorna o id do usuário que está sendo avaliado
     *
     * @param Diaria $diaria
     * @return integer
     */
    private function obtemUsuarioAvaliadoID(Diaria $diaria): int
    {
        $tipoUsuarioLogado = Auth::user()->tipo_usuario;

        if ($tipoUsuarioLogado == 1) {
            return $diaria->diarista_id;
        }

        return $diaria->cliente_id;
    }
}
