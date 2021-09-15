<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\CriarDiaria;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiariaRequest;
use App\Http\Resources\Diaria;
use App\Http\Resources\DiariaCollection;
use App\Models\Diaria as ModelDiaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();

        $diarias = ModelDiaria::todasDoUsuario($usuario);

        return new DiariaCollection($diarias);
    }

    /**
     * Grava uma nova diária no banco de dadados
     *
     * @param  DiariaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        DiariaRequest $request,
        CriarDiaria $criarDiaria
    ) {
        $diaria = $criarDiaria->executar($request->all());

        return response(new Diaria($diaria), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  ModelDiaria $diaria
     * @return \Illuminate\Http\Response
     */
    public function show(ModelDiaria $diaria)
    {
        Gate::authorize('dono-diaria', $diaria);

        return new Diaria($diaria);
    }
}
