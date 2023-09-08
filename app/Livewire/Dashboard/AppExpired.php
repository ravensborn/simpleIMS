<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class AppExpired extends Component
{
    public function render()
    {
        return view('livewire.dashboard.app-expired')
            ->extends('layouts.base')
            ->section('content');
    }
}
