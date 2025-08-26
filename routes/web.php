<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisfrazController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ReservaController;




Route::get('/', [DisfrazController::class, 'index'])->name('disfraz.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');
Route::patch('/reserva/{reserva}/entregado', [ReservaController::class, 'marcarEntregado'])
    ->name('Reserva.entregado')
    ->middleware(['auth']);

Route::get('/reserva/historial', [ReservaController::class, 'historial'])
    ->name('Reserva.historial')
    ->middleware('auth');

    // Admin Inventario
Route::get('/admin/inventario', [DisfrazController::class, 'inventario'])->name('inventario.index');
Route::post('/admin/inventario', [DisfrazController::class, 'store'])->name('inventario.store');
Route::delete('/admin/inventario/{id}', [DisfrazController::class, 'destroy'])->name('inventario.destroy');
Route::patch('/admin/inventario/{id}', [DisfrazController::class, 'update'])->name('inventario.update');


// --------------------
// Rutas de reservas (solo usuarios autenticados)
// --------------------
Route::middleware('auth')->group(function () {

    // Carrito temporal
    Route::get('/reserva', [ReservaController::class, 'index'])->name('Reserva.index');

    // Confirmación antes de guardar
Route::post('/reserva/confirmar', [ReservaController::class, 'confirmar'])->name('Reserva.confirmar');
Route::post('/reservas', [ReservaController::class, 'store'])->name('Reserva.store');

    // Acciones sobre carrito (eliminar / editar item)
    Route::post('/reserva/editar', [ReservaController::class, 'editar'])->name('reserva.editar');

Route::delete('/reserva/eliminar/{id}', [ReservaController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');



    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
