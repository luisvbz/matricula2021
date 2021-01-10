<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.index')
            ->extends('layouts.front')
            ->section('content');
    }
}
