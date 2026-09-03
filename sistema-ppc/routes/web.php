<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\CamaraController;
use App\Http\Controllers\PropostaController;
use Illuminate\Support\Facades\Route;

// Rotas de Autenticação (Públicas / Visitante)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout (Autenticado)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rota raiz redireciona para login ou sistema
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return match($user->perfil) {
            'UNIDADE' => redirect()->route('unidade.propostas.index'),
            'AVALIADOR' => redirect()->route('avaliador.index'),
            'CAMARA' => redirect()->route('camara.index'),
            default => redirect()->route('unidade.propostas.index'),
        };
    }
    return redirect()->route('login');
});

// Proteção por Autenticação (`auth`)
Route::middleware('auth')->group(function () {
    // Ações da Unidade Acadêmica
    Route::prefix('unidade')->name('unidade.')->group(function () {
        Route::get('/propostas', [PropostaController::class, 'index'])->name('propostas.index');
        Route::get('/propostas/nova', [PropostaController::class, 'create'])->name('propostas.create');
        Route::post('/propostas', [PropostaController::class, 'store'])->name('propostas.store');
        Route::get('/propostas/{proposta}/editar', [PropostaController::class, 'edit'])->name('propostas.edit');
        Route::put('/propostas/{proposta}', [PropostaController::class, 'update'])->name('propostas.update');
    });

    // Ações do Avaliador Técnico
    Route::prefix('avaliador')->name('avaliador.')->group(function () {
        Route::get('/propostas', [AvaliacaoController::class, 'index'])->name('index');
        Route::get('/propostas/{proposta}/avaliar', [AvaliacaoController::class, 'avaliar'])->name('avaliar');
        Route::post('/propostas/{proposta}/parecer', [AvaliacaoController::class, 'salvarParecer'])->name('parecer');
    });

    // Ações da Câmara de Ensino
    Route::prefix('camara')->name('camara.')->group(function () {
        Route::get('/propostas', [CamaraController::class, 'index'])->name('index');
        Route::get('/propostas/{proposta}/decisao', [CamaraController::class, 'decisao'])->name('decisao');
        Route::post('/propostas/{proposta}/homologar', [CamaraController::class, 'homologar'])->name('homologar');
    });
});
