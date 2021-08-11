<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Servico\ObtemServicos;
use App\Http\Controllers\Usuario\CadastroController;
use App\Http\Controllers\Endereco\BuscaCepApiExterna;
use App\Http\Controllers\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Diarista\VerificaDisponibilidade;
use App\Http\Controllers\Usuario\AutenticacaoController;

Route::get('/', IndexController::class);

Route::post('/token', [AutenticacaoController::class, 'login'])->name('autenticacao.login');
Route::get('/me', [AutenticacaoController::class, 'me'])->name('usuario.show');
Route::post('/logout', [AutenticacaoController::class, 'logout'])->name('autenticacao.logout');
Route::post('/token/refresh', [AutenticacaoController::class, 'refresh'])->name('autenticacao.refresh');

Route::get('/diaristas/localidades', ObtemDiaristasPorCEP::class)->name('diaristas.buca_por_cep');
Route::get('/diaristas/disponibilidade', VerificaDisponibilidade::class)->name('enderecos.disponibilidade');
Route::get('/enderecos', BuscaCepApiExterna::class)->name('enderecos.cep');

Route::get('/servicos', ObtemServicos::class)->name('servicos.index');

Route::post('/usuarios', [CadastroController::class, 'store'])->name('usuarios.create');