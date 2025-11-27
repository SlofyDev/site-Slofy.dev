<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\ProfileController;

// Auth controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\FreelancerRegisterController;
use App\Http\Controllers\Auth\EmpresaRegisterController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Páginas estáticas - CORRIGIDO: usando indexSobre
Route::get('/sobre', function () {
    return view('indexSobre');
})->name('sobre');

Route::get('/politica', function () {
    return view('politica');
})->name('politica');

Route::get('/termos', function () {
    return view('termos');
})->name('termos');

// Contato
Route::get('/contato', function () {
    return view('contato');
})->name('contato');
Route::post('/contato', [ContatoController::class, 'enviar'])->name('contato.enviar');

// Listagens públicas
Route::get('/freelancers', [FreelancerController::class, 'index'])->name('freelancers.index');
Route::get('/freelancers/{id}', [FreelancerController::class, 'show'])->name('freelancers.show');
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');

// VAGAS PÚBLICAS
Route::get('/vagas', [VagaController::class, 'index'])->name('vagas.index');
Route::get('/vagas/buscar', [VagaController::class, 'buscar'])->name('vagas.buscar');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registro
Route::get('/register/freelancer', [FreelancerRegisterController::class, 'create'])->name('register.freelancer');
Route::post('/register/freelancer', [FreelancerRegisterController::class, 'store'])->name('register.freelancer.store');

Route::get('/register/empresa', [EmpresaRegisterController::class, 'create'])->name('register.empresa');
Route::post('/register/empresa', [EmpresaRegisterController::class, 'store'])->name('register.empresa.store');

/*
|--------------------------------------------------------------------------
| Área Protegida (Dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete-image', [ProfileController::class, 'deleteProfileImage'])->name('profile.delete-image');

    // VAGAS - ROTAS COMPLETAS (ORDEM CORRETA: ESPECÍFICAS PRIMEIRO)
    Route::get('/vagas/create', [JobController::class, 'create'])->name('vagas.create');
    Route::get('/vagas/gerenciar', [JobController::class, 'manage'])->name('vagas.manage');
    
    // ROTAS DE EDIÇÃO
    Route::get('/vagas/{job}/edit', [JobController::class, 'edit'])->name('vagas.edit');
    Route::put('/vagas/{job}', [JobController::class, 'update'])->name('vagas.update');
    
    Route::post('/vagas', [JobController::class, 'store'])->name('vagas.store');
    Route::post('/vagas/{job}/aplicar', [JobController::class, 'apply'])->name('vagas.apply');
    Route::patch('/vagas/candidatura/{application}', [JobController::class, 'updateApplicationStatus'])->name('vagas.application.update');

    // Candidaturas
    Route::get('/candidaturas', [JobController::class, 'myApplications'])->name('applications.index');
});

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS COM PARÂMETROS (POR ÚLTIMO)
|--------------------------------------------------------------------------
*/
Route::get('/vagas/{job}', [JobController::class, 'show'])->name('vagas.show');

/*
|--------------------------------------------------------------------------
| Rotas de Debug (manter no final)
|--------------------------------------------------------------------------
*/

Route::get('/debug-rotas', [DebugController::class, 'rotas']);
Route::get('/test-manage', [DebugController::class, 'testManage']);
Route::get('/test-jobcontroller', [DebugController::class, 'testJobController']);
Route::get('/test-middleware', [DebugController::class, 'testMiddleware']);