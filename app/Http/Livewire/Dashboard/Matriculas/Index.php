<?php

namespace App\Http\Livewire\Dashboard\Matriculas;

use App\Models\Historial;
use App\Models\Matricula;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Index extends Component
{
    use WithPagination;

    public $grado = '';
    public $nivel = '';
    public $search = '';
    public $estado = '';

    protected $queryString = [
        'estado' =>  ['except' => ''],
        'grado' =>  ['except' => ''],
        'nivel' =>  ['except' => ''],
        'search' => ['except' => '']
    ];

    protected $listeners = ['confirm:matricula' => 'confirmMatricula', 'anular:matricula' => 'anularMatricula'];

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
        $this->reset(['search', 'grado', 'nivel', 'estado']);
        $this->render();
    }

    public function showDialogConfirmMatricula($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Estas seguro(a)?',
            'text'        => "Esta acción macarcara la matricula como confirmada",
            'confirmText' => 'Sí Confirmar!',
            'method'      => 'confirm:matricula',
            'params'      => [$id], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function showDialogAnularMatricula($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Estas seguro(a)?',
            'text'        => "Esta acción anulara la matrícula",
            'confirmText' => 'Sí Confirmar!',
            'method'      => 'anular:matricula',
            'params'      => [$id], // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function confirmMatricula($params)
    {
        try {

            Matricula::find($params[0])->update(['estado' => 1]);

            $mat = Matricula::find($params[0]);
            Historial::create(['user_id' => auth()->user()->id, 'accion' => 'Confirmar matrícula: '.$mat->codigo]);

            $this->emit('swal:modal', [
                'type'  => 'success',
                'title' => 'Exito!!',
                'text'  => "La matrícula se ha marcado como confirmada",
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

    public function anularMatricula($params)
    {
        try {

            Matricula::find($params[0])->update(['estado' => 2]);

            $mat = Matricula::find($params[0]);
            Historial::create(['user_id' => auth()->user()->id, 'accion' => 'Anular matrícula: '.$mat->codigo]);

            $this->emit('swal:modal', [
                'type'  => 'success',
                'title' => 'Exito!!',
                'text'  => "La matrícula se ha anulado con éxito",
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

    public function descargarFicha($id)
    {

        $matricula = Matricula::find($id);
        $pdf = PDF::loadView('pdfs.ficha', ['matricula' => $matricula]);
        Historial::create(['user_id' => auth()->user()->id, 'accion' => 'Descargar ficha de Matrícula: '.$matricula->codigo]);
        //dd($pdf);
        return response()->streamDownload(function () use($pdf){
            echo $pdf->stream();
        }, "FICHA-{$matricula->codigo}.pdf");
    }

    public function render()
    {

        $year = 2021;
        $totalRegistros = Matricula::where('anio', $year)->count();
        $totalPendientes = Matricula::where('anio', $year)->whereEstado(0)->count();
        $totalConfirmadas = Matricula::where('anio', $year)->whereEstado(1)->count();
        $totalAnuladas = Matricula::where('anio', $year)->whereEstado(2)->count();

        $matriculas = Matricula::orderBy('id', 'DESC')
                    ->selectRaw('matriculas.*')
                    ->join('alumnos', 'alumnos.id', '=', 'matriculas.alumno_id')
                    ->where('matriculas.anio', $year)
                    ->when($this->search != '', function ($q){
                        $q->whereRaw('alumnos.apellido_paterno = ? 
                                      OR alumnos.apellido_materno = ? 
                                      OR alumnos.nombres = ? 
                                      OR alumnos.numero_documento = ?',
                                        [$this->search,
                                         $this->search,
                                         $this->search,
                                         $this->search]);
                    })
                    ->when($this->nivel != '', function ($q){
                        $q->where('matriculas.nivel', $this->nivel);
                    })
                    ->when($this->grado != '', function ($q){
                        $q->where('matriculas.grado', $this->grado);
                    })
                    ->when($this->estado != '', function ($q){
                        $q->where('matriculas.estado', $this->estado);
                    })
                    ->paginate(30);

        return view('livewire.dashboard.matriculas.index', ['matriculas' => $matriculas,
                                                            'total' => $totalRegistros,
                                                            'pendientes' => $totalPendientes,
                                                            'confirmadas' => $totalConfirmadas,
                                                            'anuladas' => $totalAnuladas,])
                ->extends('layouts.panel')
                ->section('content');
    }
}
