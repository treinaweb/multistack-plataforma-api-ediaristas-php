<?php

namespace App\Http\Controllers\Usuario;

use App\Actions\Usuario\AtualizarUsuario;
use App\Actions\Usuario\CriarUsuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioAlteracaoRequest;
use App\Http\Requests\UsuarioCadastroRequest;
use App\Http\Resources\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CadastroController extends Controller
{
    public function __construct(
        private CriarUsuario $criarUsuario,
        private AtualizarUsuario $atualizarUsuario
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioCadastroRequest $request)
    {
        $usuario = $this->criarUsuario->executar(
            $request->except('password_confirmation'),
            $request->foto_documento
        );

        $token = Auth::attempt([
            'email' => $usuario->email,
            'password' => $request->password
        ]);

        return new Usuario($usuario, $token);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioAlteracaoRequest $request)
    {
        $this->atualizarUsuario->executar($request->all());
    }
}
