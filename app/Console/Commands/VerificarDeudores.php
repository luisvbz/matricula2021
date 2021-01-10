<?php

namespace App\Console\Commands;

use App\Mail\RecordatorioPago;
use App\Models\CronogramaPagos;
use App\Models\Matricula;
use App\Models\Pension;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class VerificarDeudores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:deudores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar Deudores';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
            foreach ($deudores as $moroso)
            {
                $alumno = $moroso->matricula->alumno;
                $padre = $moroso->matricula->alumno->padres()->where('parentesco', 'P')->first();
                $madre = $moroso->matricula->alumno->padres()->where('parentesco', 'M')->first();

                if($padre){
                    Mail::to($padre->correo_electronico)->send(new RecordatorioPago($alumno, $padre, $moroso->meses));
                }

                if($madre){
                    Mail::to($madre->correo_electronico)->send(new RecordatorioPago($alumno, $madre, $moroso->meses));
                }

                sleep(3);
            }
        }
    }
}
