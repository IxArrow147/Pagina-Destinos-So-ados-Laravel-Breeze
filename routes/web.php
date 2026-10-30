<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page
Route::get('/', function () {
    return view('landing_page');
})->name('landing_page');

// 2. Dashboard (Protegido solo por auth, no por admin)
Route::get('/dashboard', function () {
    $totalClientes = \App\Models\Cliente::count();
    $totalReservas = \App\Models\Reserva::count();
    $ultimasReservas = \App\Models\Reserva::with('cliente')->latest('id_reserva')->take(5)->get();
    return view('dashboard', compact('totalClientes', 'totalReservas', 'ultimasReservas'));
})->middleware(['auth', 'verified'])->name('dashboard');

//2.5 Rutas Publicas
Route::middleware('auth')->group(function () {
   
});

// 3. Rutas protegidas para ADMINISTRADORES
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('destinos', App\Http\Controllers\DestinoController::class);
    Route::resource('reservas', App\Http\Controllers\ReservaController::class);
});

// 4. Perfil de usuario (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. Autenticación
require __DIR__.'/auth.php';