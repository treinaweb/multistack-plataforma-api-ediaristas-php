<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Diaria\PagaDiaria;
use App\Http\Controllers\Diaria\AvaliaDiaria;
use App\Http\Controllers\Diaria\CancelaDiaria;
use App\Http\Controllers\Diaria\Oportunidades;
use App\Http\Controllers\Diarista\ObtemEndereco;
use App\Http\Controllers\Diaria\ConfirmaPresenca;
use App\Http\Controllers\Diarista\DefineEndereco;
use App\Http\Controllers\Diaria\CandidataDiarista;
use App\Http\Controllers\Usuario\DefineFotoPerfil;
use App\Http\Controllers\Usuario\CadastroController;
use App\Http\Controllers\Diarista\ObtemCidadesAtendidas;
use App\Http\Controllers\Usuario\AutenticacaoController;
use App\Http\Controllers\Diarista\DefineCidadesAtendidas;
use App\Http\Controllers\Pagamento\ObtemPagamentosDiarista;
use App\Http\Controllers\Diaria\CadastroController as DiariaCadastroController;


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', [AutenticacaoController::class, 'me'])->name('usuarios.show');

    Route::get('/diarias', [DiariaCadastroController::class, 'index'])->name('diarias.index');
    Route::post('/diarias', [DiariaCadastroController::class, 'store'])->name('diarias.store');
    Route::get('/diarias/{diaria}', [DiariaCadastroController::class, 'show'])->name('diarias.show');

    Route::put('/usuarios', [CadastroController::class, 'update'])->name('usuarios.update');
    Route::post('/usuarios/foto', DefineFotoPerfil::class)->name('usuarios.definir-foto');

    Route::put('/usuarios/endereco', DefineEndereco::class)->name('usuarios.definir-endereco');
    Route::get('/usuarios/endereco', ObtemEndereco::class)->name('usuarios.obter-endereco');
    Route::put('/usuarios/cidades-atendidas', DefineCidadesAtendidas::class)->name('usuarios.definir-cidades');
    Route::get('/usuarios/cidades-atendidas', ObtemCidadesAtendidas::class)->name('usuarios.obter-cidades');

    Route::post('/diarias/{diaria}/pagamentos', PagaDiaria::class)->name('diarias.pagar');

    Route::post('/diarias/{diaria}/candidatas', CandidataDiarista::class)->name('diarias.candidatar');
    Route::get('/oportunidades', Oportunidades::class)->name('oportunidades.index');

    Route::patch('/diarias/{diaria}/presenca', ConfirmaPresenca::class)->name('diarias.confirmar');
    Route::patch('/diarias/{diaria}/avaliacoes', AvaliaDiaria::class)->name('diarias.avaliar');

    Route::patch('/diarias/{diaria}/cancelado', CancelaDiaria::class)->name('diarias.cancelar');

    Route::get('/pagamentos', ObtemPagamentosDiarista::class)->name('pagamentos.index');
});
