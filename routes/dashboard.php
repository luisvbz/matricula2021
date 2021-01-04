<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/', \App\Http\Livewire\Dashboard\Index::class)->name('dashboard.principal')->middleware('role:Admin|Operador');
    Route::get('/matriculas', \App\Http\Livewire\Dashboard\Matriculas\Index::class)->name('dashboard.matriculas')->middleware('role:Admin|Operador');
    Route::get('/matriculas/{codigo}/detalle', \App\Http\Livewire\Dashboard\Matriculas\Detalle::class)->name('dashboard.detalle-matricula')->middleware('role:Admin|Operador');
    Route::get('/pagos', \App\Http\Livewire\Dashboard\Pagos\Index::class)->name('dashboard.pagos')->middleware('role:Admin|Operador');
    Route::get('/configuracion-general', \App\Http\Livewire\Dashboard\Configuracion::class)
        ->middleware('role:Admin')
        ->name('dashboard.configuracion');
});

Route::get('/login', \App\Http\Livewire\Dashboard\Login::class)->name('admin.login');
