<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $diaristas = User::where('tipo_usuario', '=', 2)->get();

        return $diaristas;
    }
}
