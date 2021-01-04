<?php

namespace App\Http\Livewire\Frontend;

use App\Mail\NuevaMatricula;
use App\Mail\NuevoPago;
use App\Models\Matricula;
use App\Models\Pago;
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
    public $pago = [
        'concepto' => 'M',
        'tipo_pago' => '',
        'numero_operacion' => null,
        'monto_pagado' => null,
        'comprobante' => null,
        'fecha' => null
    ];

    public $rules = [
        'pago.tipo_pago' => 'required',
        'pago.numero_operacion' => 'required',
        'pago.fecha' => 'required|date_format:d/m/Y',
        'pago.monto_pagado' => 'required',
        'pago.comprobante' => 'required|image|max:2048'
    ];

    public $messages = [
        'pago.tipo_pago.required' => 'Debe seleccionar el tipo de pago',
        'pago.numero_operacion.required' => 'Este campo es requerido',
        'pago.fecha.required' => 'Indique la fecha de pago',
        'pago.monto_pagado.required' => 'Debe ingresar el monto pagado',
        'pago.fecha.date_format' => 'El formato debe ser DD/MM/YYYY',
        'pago.comprobante.required' => 'Debe agregar un imagen del comprobante',
        'pago.comprobante.image' => 'Debe ser una imagen válida',
        'pago.comprobante.max' => 'La imagen no puede pesar mas de 2MB',
    ];

    use WithFileUploads;

    protected $listeners = ['goToStep'];


    public function updated($field)
    {
        $this->validateOnly($field, $this->rules, $this->messages);
    }

    public function buscarMatricula()
    {
        $this->validate(['codigo' => 'required'],['codigo.required' => 'Debe ingresar el código']);

        try {

            $this->matricula = Matricula::where('codigo', $this->codigo)->first();

            if(!$this->matricula)
            {
                throw new \Exception("La matricula con el código <b>{$this->codigo}</b> no se ha encontrado, verifique el código e intente de nuevo");
            }

            $this->step = 2;

            $this->emit('paso:dos:pago');

        }catch (\Exception $e){
            $this->emit('swal:modal', [
                'icon' => 'error',
                'title' => 'Error!!',
                'text' => $e->getMessage(),
                'timeout' => 3000
            ]);
        }
    }


    public function registrarPago()
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

            Mail::to('divinosalvador20072@gmail.com')->cc('ing.luisvasquez89@gmail.com')->send(new NuevoPago($pay));


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
