<?php

namespace App\Http\Livewire\Dashboard\Contabilidad;

use App\Mail\RecordatorioPago;
use App\Models\CronogramaPagos;
use App\Models\Matricula;
use App\Models\Pension;
use Livewire\Component;

class Reportes extends Component
{
    public function reporteDePagos ()
    {

    }

    public function reporteDeudores ()
    {
        $cronograma = CronogramaPagos::orderBy('orden', 'ASC')->get();
        $hoy = date('Y-m-d');
        $pagos = collect();
        $deudores = collect();
        //verificar quienes pagaron la pensión
        foreach ($cronograma as $crono)
        {
            if($crono->vencimiento){
                $pagadas = Pension::where('mes', $crono->mes)->where('estado', '<>', 2)->pluck('codigo_matricula');
                $item = new \stdClass();
                $item->mes = $crono->mes;
                $item->pagadas = $pagadas;
                $pagos->push($item);
            }
        }
        //buscar las matriculas que no ha pagado
        foreach ($pagos as $matPago)
        {
            $matriculas = Matricula::whereNotIn('codigo', $matPago->pagadas)->get();

            foreach ($matriculas as $matricula)
            {
                $deudor  = $deudores->where('codigo', $matricula->codigo)->first();
                if($deudor)
                {
                    array_push($deudor->meses, CronogramaPagos::where('mes', $matPago->mes)->first());
                }else {
                    $ma = new \stdClass();
                    $ma->codigo = $matricula->codigo;
                    $ma->matricula = $matricula;
                    $ma->meses = [CronogramaPagos::where('mes', $matPago->mes)->first()];
                    $deudores->push($ma);
                }
            }
        }

        if(count($deudores) > 0)
        {
            dd($deudores);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.contabilidad.reportes')
            ->extends('layouts.panel')
            ->section('content');
    }
}
