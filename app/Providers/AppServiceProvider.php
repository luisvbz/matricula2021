<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Pine\BladeFilters\BladeFilters;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        BladeFilters::macro('dateFormat', function ($value) {
            $fecha = date('d/m/Y', strtotime($value));
            return  $fecha;
        });


        BladeFilters::macro('grado', function ($value) {

            switch ($value) {
                case 1:
                    return "PRIMERO";
                    break;
                case 2:
                    return "SEGUNDO";
                    break;
                case 3:
                    return "TERCERO";
                    break;
                case 4:
                    return "CUARTO";
                    break;
                case 5:
                    return "QUINTO";
                    break;
                case 6:
                    return "SEXTO";
                    break;
            }
        });

        BladeFilters::macro('edoCivil', function ($value) {

            switch ($value) {
                case 'S':
                    return "SOLTERO(A)";
                    break;
                case 'C':
                    return "CASADO(A)";
                    break;
                case 'D':
                    return "DIVORCIADO(A)";
                    break;
                case 'V':
                    return "VIUDO(A)";
                    break;
            }
        });

        BladeFilters::macro('mp', function ($value) {

            switch ($value) {
                case 'A':
                    return "Agente";
                    break;
                case 'D':
                    return "Deposito";
                    break;
                case 'T':
                    return "Transferencia";
                    break;
                case 'Y':
                    return "Yape";
                    break;
            }
        });

        BladeFilters::macro('mes', function ($value) {

            switch ($value) {
                case '01':
                    return "Enero";
                    break;
                case '02':
                    return "Febrero";
                    break;
                case '03':
                    return "Marzo";
                    break;
                case '04':
                    return "Abril";
                    break;
                case '05':
                    return "Mayo";
                    break;
                case '06':
                    return "Junio";
                    break;
                case '07':
                    return "Julio";
                    break;
                case '08':
                    return "Agosto";
                    break;
                case '09':
                    return "Setiembre";
                    break;
                case '10':
                    return "Octubre";
                    break;
                case '11':
                    return "Noviembre";
                    break;
                case '12':
                    return "Diciembre";
                    break;
            }
        });

        BladeFilters::macro('parseStatus', function ($value){
            switch ($value) {
                case 0:
                    return '<i class="fas fa-circle has-text-warning"></i>';
                    break;
                case 1:
                    return '<i class="fas fa-circle has-text-success"></i>';
                    break;
                case 2:
                    return '<i class="fas fa-circle has-text-danger"></i>';
                    break;
            }
        });
    }
}
