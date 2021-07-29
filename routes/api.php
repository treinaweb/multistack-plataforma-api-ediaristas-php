<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Diarista\VerificaDisponibilidade;
use App\Http\Controllers\Endereco\BuscaCepApiExterna;

Route::get('/diaristas/localidades', ObtemDiaristasPorCEP::class)->name('diaristas.buca_por_cep');
Route::get('/diaristas/disponibilidade', VerificaDisponibilidade::class)->name('enderecos.disponibilidade');
Route::get('/enderecos', BuscaCepApiExterna::class)->name('enderecos.cep');