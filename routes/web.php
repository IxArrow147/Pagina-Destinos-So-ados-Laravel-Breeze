<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. RUTA PRINCIPAL (Landing Page)
Route::get('/', function () {
    return view('landing_page');
})->name('landing_page');

//2. RUTAS PUBLICAS
Route::middleware('auth')->group(function () {
    Route::resource('destinos', App\Http\Controllers\DestinoController::class);
});
// 3. RUTAS DE BREEZE (Dashboard y Perfil)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. RUTAS DE AUTENTICACIÓN (Login, Registro, etc.)
require __DIR__.'/auth.php';
