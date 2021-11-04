<?php

namespace App\Actions\Diaria;

use App\Models\Diaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Tasks\Usuario\AtualizaReputacao;
use App\Checkers\Diaria\ValidaStatusDiaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AvaliarDiaria
{
    public function __construct(
        private AtualizaReputacao $atualizaReputacao,
        private ValidaStatusDiaria $validaStatusDiaria
    ) {
    }

    /**
     * Define a avaliação do usuário logado para a diária
     *
     * @param Diaria $diaria
     * @param array $dadosAvaliacao
     * @return void
     */
    public function executar(Diaria $diaria, array $dadosAvaliacao): void
    {
        Gate::authorize('dono-diaria', $diaria);
        $this->validaStatusDiaria->executar($diaria, 4);
        $this->verificaDuplicidadeDeAvaliacao($diaria);

        $this->criaAvaliacao($diaria, $dadosAvaliacao);

        $this->atualizaReputacao->executar(
            $this->obtemUsuarioAvaliadoID($diaria)
        );

        $this->defineStatusAvalido($diaria);
    }

    /**
     * Verifica se o usuário logado já avaliou a diária
     *
     * @param Diaria $diaria
     * @return void
     */
    private function verificaDuplicidadeDeAvaliacao(Diaria $diaria): void
    {
        $usuarioLogado = Auth::user();

        $usuarioJaAvaliou = $diaria->usuarioJaAvaliou($usuarioLogado->id);

        if ($usuarioJaAvaliou) {
            throw ValidationException::withMessages([
                'avaliador_id' => 'O usuário já avaliou essa diária'
            ]);
        }
    }

    /**
     * Cria uma avaliação para a diária
     *
     * @param Diaria $diaria
     * @param array $dadosAvaliacao
     * @return Model
     */
    private function criaAvaliacao(Diaria $diaria, array $dadosAvaliacao): Model
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

    /**
     * muda o status da diária para avaliado 
     * quando as duas partes já realizaram a avaliação
     *
     * @param Diaria $diaria
     * @return boolean
     */
    private function defineStatusAvalido(Diaria $diaria): bool
    {
        $quantidadeAvaliacoes = $diaria->avaliacoes()->count();

        if ($quantidadeAvaliacoes == 2) {
            return $diaria->update(['status' => '6']);
        }

        return false;
    }
}
