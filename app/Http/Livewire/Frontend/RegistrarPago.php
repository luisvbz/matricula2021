<?php

namespace App\Http\Livewire\Frontend;

use App\Mail\NuevaMatricula;
use App\Mail\NuevoPago;
use App\Mail\NuevoPagoPension;
use App\Models\CronogramaPagos;
use App\Models\Matricula;
use App\Models\Pago;
use App\Models\Pension;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrarPago extends Component
{
    public $step = 1;
    public $matricula;
    public $codigo;
    public $concepto = 'M';
    public $pago = [
        'concepto' => 'M',
        'tipo_pago' => '',
        'numero_operacion' => null,
        'monto_pagado' => null,
        'comprobante' => null,
        'fecha' => null
    ];

    public $pensiones = [];

    public $pagopension = [
        'mes' => '',
        'monto' => null,
        'comprobante' => null,
        'fecha_pago' => null
    ];

    public $rules = [
        'pago.tipo_pago' => 'required_if:concepto,M',
        'pago.numero_operacion' => 'required_if:concepto,M',
        'pago.fecha' => 'required_if:concepto,M|date_format:d/m/Y',
        'pago.monto_pagado' => 'required_if:concepto,M',
        'pago.comprobante' => 'required_if:concepto,M|image|max:2048',
    ];

    public $messages = [
        'pago.tipo_pago.required_if' => 'Debe seleccionar el tipo de pago',
        'pago.numero_operacion.required_if' => 'Este campo es requerido',
        'pago.fecha.required_if' => 'Indique la fecha de pago',
        'pago.monto_pagado.required_if' => 'Debe ingresar el monto pagado',
        'pago.fecha.date_format' => 'El formato debe ser DD/MM/YYYY',
        'pago.comprobante.required_if' => 'Debe agregar un imagen del comprobante',
        'pago.comprobante.image' => 'Debe ser una imagen válida',
        'pago.comprobante.max' => 'La imagen no puede pesar mas de 2MB'
    ];

    use WithFileUploads;

    protected $listeners = ['goToStep'];


    public function updated($field)
    {
        $this->validateOnly($field, $this->rules, $this->messages);
    }

    public function updatedPagopensionMes()
    {
        $costo =  CronogramaPagos::where('mes', $this->pagopension['mes'])->first();

        $this->pagopension['monto'] = $costo->costo;
    }


    public function buscarMatricula()
    {
        $this->validate(['codigo' => 'required'], ['codigo.required' => 'Debe ingresar el código']);

        try {
            $dni = trim($this->codigo);
            $COD = "IEPDS-{$dni}-2021";
            $this->matricula = Matricula::where('codigo', $COD)->first();

            if (!$this->matricula) {
                throw new \Exception("La matricula con el DNI <b>{$dni}</b> no se ha encontrado, verifique e intente de nuevo");
            }

            if(Pago::where('codigo_matricula', $COD)->where('estado', '<>', 2)->exists()){
                $this->concepto = 'P';
            }

            $this->step = 2;

        } catch (\Exception $e) {
            $this->emit('swal:modal', [
                'icon' => 'error',
                'title' => 'Error!!',
                'text' => $e->getMessage(),
                'timeout' => 3000
            ]);
        }
    }

    public function seleccionarConcepto()
    {
        $this->pensiones = [];
        if($this->codigo == 'M')
        {
            $this->step = 3;
            $this->emit('paso:tres:pago');
        }else {
            $cronograma = CronogramaPagos::orderBy('orden', 'ASC')->get();

            if(!Pension::where('codigo_matricula', $this->matricula->codigo)->exists()){
                foreach ($cronograma as $crono)
                {
                    if($crono->mes == 03)
                    {
                        $item = ['value' => $crono->mes, 'mes' => getMes($crono->mes), 'costo' => $crono->costo, 'disabled' => false];
                    }else {
                        $item = ['value' => $crono->mes, 'mes' => getMes($crono->mes), 'costo' => $crono->costo, 'disabled' => true];
                    }

                    array_push($this->pensiones, $item);
                }

                $this->step = 3;
                $this->emit('paso:tres:pago');
            }else {
                $aux = 1;
                foreach ($cronograma as $crono) {
                    $pen = Pension::where('codigo_matricula', $this->matricula->codigo)->where('mes', $crono->mes)->first();

                    if (!$pen)
                    {
                        if($aux == 1)
                        {
                            $item = ['value' => $crono->mes, 'mes' => getMes($crono->mes), 'costo' => $crono->costo, 'disabled' => false];
                        }else {
                            $item = ['value' => $crono->mes, 'mes' => getMes($crono->mes), 'costo' => $crono->costo, 'disabled' => true];
                        }

                        array_push($this->pensiones, $item);
                        $aux++;
                    }
                }

                $this->step = 3;
                $this->emit('paso:tres:pago');
            }
        }
    }

    public function registrarPagoPension()
    {
        $this->validate([
            'pagopension.mes' => 'required_if:concepto,P',
            'pagopension.comprobante' => 'required_if:concepto,P|image|max:2048',
            'pagopension.fecha_pago' => 'required_if:concepto,P|date_format:d/m/Y',
        ], [
            'pagopension.comprobante.required_if' => 'Debe agregar un imagen del comprobante',
            'pagopension.comprobante.image' => 'Debe ser una imagen válida',
            'pagopension.comprobante.max' => 'La imagen no puede pesar mas de 2MB',
            'pagopension.mes.required_if' => 'Debe seleccionar el mes',
            'pagopension.fecha_pago.required_if' => 'Indique la fecha de pago',
            'pagopension.fecha_pago.date_format' => 'El formato debe ser DD/MM/YYYY',
        ]);

        try {

            if(Pension::where('codigo_matricula', $this->matricula->codigo)->where('estado', 0)->exists())
            {
                $this->emit('swal:modal', [
                    'icon' => 'warning',
                    'title' => 'Adevertencia!!',
                    'text' => 'Cuando su pago anterior esté verificado podrá registrar este',
                    'timeout' => 3000
                ]);

                return;
            }

            $comprobanteName = "{$this->matricula->codigo}-{$this->pagopension['mes']}-{$this->matricula->anio}.{$this->pagopension['comprobante']->getClientOriginalExtension()}";
            $this->pagopension['comprobante']->storeAs("comprobantes",$comprobanteName);

            if(!Storage::exists("comprobantes/$comprobanteName"))
            {
                throw new \Exception('Ocurrio un error al subir el comprobante');
            }

            DB::beginTransaction();

           $pension =  Pension::create([
                'estado' => 0,
                'codigo_matricula' => $this->matricula->codigo,
                'mes' =>  $this->pagopension['mes'],
                'costo' => $this->pagopension['monto'],
                'comprobante' => $comprobanteName,
                'fecha_pago' => date_to_datedb($this->pagopension['fecha_pago'], "/")
            ]);

            DB::commit();

            $this->emit('swal:modal', [
                'icon' => 'success',
                'title' => 'Exito!!',
                'text' => 'Su pago fue registrado con exito, pronto lo estaremos verificando!',
                'timeout' => 3000
            ]);

            Mail::to('divinosalvador20072@gmail.com')->send(new NuevoPagoPension($pension));

            $this->reset(['pago', 'pagopension', 'step', 'codigo']);

        } catch (\Exception $e)
        {
            DB::rollBack();
            $this->emit('swal:modal', [
                'icon' => 'error',
                'title' => 'Error!!',
                'text' => $e->getMessage(),
                'timeout' => 3000
            ]);
        }
    }


    public function registrarPagoMatricula()
    {
        $this->validate($this->rules, $this->messages);

        try{

            $comprobanteName = strtoupper(Str::random('15')).time().".".$this->pago['comprobante']->getClientOriginalExtension();
            $this->pago['comprobante']->storeAs("comprobantes",$comprobanteName);

            if(!Storage::exists("comprobantes/$comprobanteName"))
            {
                throw new \Exception('Ocurrio un error al subir el comprobante');
            }

            DB::beginTransaction();


            $pay = Pago::create([
                'estado' => 0,
                'concepto' => $this->pago['concepto'],
                'codigo_matricula' => $this->matricula->codigo,
                'tipo_pago' => $this->pago['tipo_pago'],
                'monto_pagado' => $this->pago['monto_pagado'],
                'numero_operacion' => $this->pago['numero_operacion'],
                'fecha_deposito' => date_to_datedb($this->pago['fecha'], "/"),
                'comprobante' => $comprobanteName,
            ]);

            DB::commit();

            Mail::to('divinosalvador20072@gmail.com')->send(new NuevoPago($pay));


            $this->emit('swal:modal', [
                'icon' => 'success',
                'title' => 'Exito!!',
                'text' => 'Su pago fue registrado con exito, pronto lo estaremos verificando!',
                'timeout' => 3000
            ]);

            $this->reset(['pago', 'step', 'codigo']);

        }catch (\Exception $e){
            DB::rollBack();
            $this->emit('swal:modal', [
                'icon' => 'error',
                'title' => 'Error!!',
                'text' => $e->getMessage(),
                'timeout' => 3000
            ]);
        }
    }

    public function goToStep($paso){
        $this->step = $paso;
    }

    public function render()
    {
        return view('livewire.frontend.registrar-pago')
            ->extends('layouts.front')
            ->section('content');
    }
}
