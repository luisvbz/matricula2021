<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Livewire\Frontend\Index::class)->name('principal');
Route::get('/registrar-pago', \App\Http\Livewire\Frontend\RegistrarPago::class)->name('registrar.pago');
Route::get('/consultar-matricula/{codigo?}', \App\Http\Livewire\Frontend\ConsultarMatricula::class)->name('consultar.matricula');


Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
});
