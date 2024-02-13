<?php

namespace App\Livewire\Dashboard\Orders;

use App\Livewire\Forms\OrderForm;
use App\Models\Order;
use Livewire\Component;

class Edit extends Component
{
    public OrderForm $form;
    public Order $order;

    public function update(): void
    {
        $this->form->update();
        $this->redirectRoute('orders.index');
    }

    public function mount(Order $order): void
    {
        $this->order = $order;
        $this->form->setup($order);
    }

    public function render()
    {
        return view('livewire.dashboard.orders.edit')
            ->extends('layouts.base')
            ->section('content');
    }
}
