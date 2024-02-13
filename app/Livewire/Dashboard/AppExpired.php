<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class AppExpired extends Component
{

    public function mount() {

        $expiryDate = Carbon::parse(config('env.APP_EXPIRY_DATE'));

        if (!Carbon::now()->gt($expiryDate)) {
            $this->redirectRoute('home');
        }

    }
    public function render()
    {
        return view('livewire.dashboard.app-expired')
            ->extends('layouts.base')
            ->section('content');
    }
}
