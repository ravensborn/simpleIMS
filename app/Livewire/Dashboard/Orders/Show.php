<?php

namespace App\Livewire\Dashboard\Orders;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public Order $order;

    public function mount(Order $order): void
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.dashboard.orders.show')
            ->extends('layouts.base')
            ->section('content');
    }
}
