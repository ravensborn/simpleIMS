<?php

namespace App\Livewire\Dashboard\Orders\OrderPayments;

use App\Models\Order;
use Livewire\Component;


class Invoice extends Component
{

    public $order;
    public $orderPayment;
    public $customer;

    public function mount($order, $orderPayment): void
    {
        $this->order = Order::findOrFail($order);
        $this->orderPayment = $this->order->orderPayments->find($orderPayment);
        $this->customer = $this->order->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.order-payments.invoice')->extends('layouts.base')->section('content');
    }

}
