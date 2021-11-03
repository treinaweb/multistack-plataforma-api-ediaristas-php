<?php

namespace App\Http\Controllers\Diaria;

use App\Actions\Diaria\AvaliarDiaria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvaliaDiaria extends Controller
{
    public function __construct(
        private AvaliarDiaria $avaliarDiaria
    ) {
    }

    public function __invoke(Request $request)
    {
        $this->avaliarDiaria->executar();
    }
}
