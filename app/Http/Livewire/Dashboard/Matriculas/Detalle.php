<?php

namespace App\Http\Livewire\Dashboard\Matriculas;

use App\Models\Matricula;
use Livewire\Component;

class Detalle extends Component
{
    public $matricula;

    public function mount($codigo)
    {
        $this->matricula = Matricula::whereCodigo($codigo)->first();

        if(!$this->matricula)
        {
            abort(404);
        }

        if(auth()->user()->id == 4 && $codigo == 'IEPDS-61140703-2021')
        {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.matriculas.detalle')
            ->extends('layouts.panel')
            ->section('content');
    }
}
