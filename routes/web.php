<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NodeController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas del Panel Administrativo del Banco Central
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/nodes', [NodeController::class, 'index'])->name('nodes.index');
    Route::get('/nodes/create', [NodeController::class, 'create'])->name('nodes.create');
    Route::post('/nodes', [NodeController::class, 'store'])->name('nodes.store');
    // Ruta de Reportes Globales
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
