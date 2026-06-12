<?php

use App\Livewire\Home;
use App\Livewire\Financeiro\PlanoContas;
use App\Livewire\Financeiro\Lancamentos;
use App\Livewire\Financeiro\Relatorios;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/financeiro/plano-contas', PlanoContas::class)->name('financeiro.plano-contas');
Route::get('/financeiro/lancamentos', Lancamentos::class)->name('financeiro.lancamentos');
Route::get('/financeiro/relatorios', Relatorios::class)->name('financeiro.relatorios');

Route::get('/modulo/{module}', function (string $module) {
    return redirect()->route('home');
})->name('module.show');
