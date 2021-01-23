<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/', \App\Http\Livewire\Dashboard\Index::class)->name('dashboard.principal')->middleware('role:Admin|Operador');
    Route::get('/matriculas', \App\Http\Livewire\Dashboard\Matriculas\Index::class)->name('dashboard.matriculas')->middleware('role:Admin|Operador');
    Route::get('/recordatorios', \App\Http\Livewire\Dashboard\Recordatorios::class)->name('dashboard.recordatorios')->middleware('role:Admin|Operador');
    Route::get('/matriculas/{codigo}/detalle', \App\Http\Livewire\Dashboard\Matriculas\Detalle::class)->name('dashboard.detalle-matricula')->middleware('role:Admin|Operador');
    Route::get('/contabilidad', \App\Http\Livewire\Dashboard\Contabilidad\Index::class)->name('dashboard.contabilidad')->middleware('role:Admin|Operador');
    Route::get('/contabilidad/pagos-matriculas', \App\Http\Livewire\Dashboard\Pagos\Index::class)->name('contabilidad.pagos-matricula')->middleware('role:Admin|Operador');
    Route::get('/contabilidad/pagos-pensiones', \App\Http\Livewire\Dashboard\Contabilidad\PagosPensiones::class)->name('contabilidad.pagos-pensiones')->middleware('role:Admin|Operador');
    Route::get('/contabilidad/reportes', \App\Http\Livewire\Dashboard\Contabilidad\Reportes::class)->name('contabilidad.reportes')->middleware('role:Admin|Operador');
    Route::get('/contabilidad/cronograma-de-pagos', \App\Http\Livewire\Dashboard\Contabilidad\Cronograma::class)->name('contabilidad.cronograma')->middleware('role:Admin|Operador');
    Route::get('/configuracion-general', \App\Http\Livewire\Dashboard\Configuracion::class)
        ->middleware('role:Admin')
        ->name('dashboard.configuracion');
});

Route::get('/login', \App\Http\Livewire\Dashboard\Login::class)->name('admin.login');
