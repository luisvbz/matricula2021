<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Pension;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {

        return view('livewire.dashboard.index')
                    ->extends('layouts.panel')
                    ->section('content');
    }
}
