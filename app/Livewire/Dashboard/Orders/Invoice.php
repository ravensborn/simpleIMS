<?php

namespace App\Livewire\Dashboard\Orders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPayment;
use Livewire\Component;


class Invoice extends Component
{

    public Order $order;

    public Customer $customer;

    public function mount($order): void
    {
        $this->order = $order;
        $this->customer = $this->order->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.invoice')->extends('layouts.base')->section('content');
    }

}
