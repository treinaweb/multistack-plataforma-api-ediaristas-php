<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario\AutenticacaoController;

Route::post('/token', [AutenticacaoController::class, 'login'])->name('autenticacao.login');
Route::post('/logout', [AutenticacaoController::class, 'logout'])->name('autenticacao.logout');
Route::post('/token/refresh', [AutenticacaoController::class, 'refresh'])->name('autenticacao.refresh');