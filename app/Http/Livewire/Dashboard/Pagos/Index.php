<?php

namespace App\Http\Livewire\Dashboard\Pagos;

use App\Models\Matricula;
use App\Models\Pago;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $estado = '';
    public $showComprobante = false;
    public $imagenComprobante = '';

    protected $queryString = [
        'estado' => ['except' => ''],
        'search' => ['except' => '']
    ];

    protected $listeners = ['confirm:pago-matricula' => 'confirmPagoMatricula', 'anular:pago-matricula' => 'anularPagoMatricula'];

    public function paginationView()
    {
        return 'bulma-pagination';
    }

    public function buscar()
    {
        $this->render();
    }

    public function limpiar()
    {
        $this->reset(['search', 'estado']);
        $this->render();
    }

    public function verComprobante($comprobante)
    {
        $extension = explode(".", $comprobante);
        $image = base64_encode(Storage::get("comprobantes/$comprobante"));
        $image = "data:image/{$extension[1]};base64,{$image}";

        $this->imagenComprobante = $image;
        $this->emit('mostrar:comprobante:matricula');
       // $this->showComprobante = true;
    }

    public function showDialogConfirmMatricula($id, $codigo)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Estas seguro(a)?',
            'text'        => "Esta acción macarcara la matricula como confirmada",
            'confirmText' => 'Sí Confirmar!',
            'method'      => 'confirm:pago-matricula',
            'params'      => [$id, $codigo], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function showDialogAnularPago($id, $codigo)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Estas seguro(a)?',
            'text'        => "Al anular el pago este no podrá cambiar de estado nuevamente",
            'confirmText' => 'Sí, anular!',
            'method'      => 'anular:pago-matricula',
            'params'      => [$id, $codigo], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function confirmPagoMatricula($params)
    {
        try {

            Matricula::where('codigo',$params[1])->update(['estado' => 1]);
            Pago::find($params[0])->update(['estado' => 1]);

            $this->emit('swal:modal', [
                'type'  => 'success',
                'title' => 'Exito!!',
                'text'  => "La matrícula y el pago se han confirmado",
            ]);

            $this->render();

        } catch (\Exception $e)
        {
            $this->emit('swal:modal', [
                'type'  => 'error',
                'title' => 'Error!!',
                'text'  => $e->getMessage(),
            ]);
        }
    }

    public function anularPagoMatricula($params)
    {
        try {

            Matricula::where('codigo',$params[1])->update(['estado' => 0]);
            Pago::find($params[0])->update(['estado' => 2]);

            $this->emit('swal:modal', [
                'type'  => 'success',
                'title' => 'Exito!!',
                'text'  => "El pago se ha anulado y la matricula se ha marcado como pendiente",
            ]);

            $this->render();

        } catch (\Exception $e)
        {
            $this->emit('swal:modal', [
                'type'  => 'error',
                'title' => 'Error!!',
                'text'  => $e->getMessage(),
            ]);
        }
    }

    public function closeComprobante()
    {
        $this->reset(['imagenComprobante']);
    }

    public function render()
    {
        $pagos = Pago::when($this->estado != '', function ($q){
            $q->where('estado', $this->estado);
        })
        ->when($this->search != '', function ($q){
            $q->where('codigo_matricula', 'like', "%{$this->search}%");
        })
        ->orderBy('id', 'DESC')->paginate(30);
        $totalRegistros = Pago::count();
        $totalPendientes = Pago::whereEstado(0)->count();
        $totalConfirmados = Pago::whereEstado(1)->count();
        $totalAnulados = Pago::whereEstado(2)->count();

        return view('livewire.dashboard.pagos.index', ['pagos' => $pagos, 'total' => $totalRegistros, 'pendientes' => $totalPendientes,
                                                        'confirmados' => $totalConfirmados, 'anulados' => $totalAnulados])
            ->extends('layouts.panel')
            ->section('content');
    }
}
