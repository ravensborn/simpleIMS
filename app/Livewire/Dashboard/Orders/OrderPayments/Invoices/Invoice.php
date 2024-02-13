<?php

namespace App\Livewire\Dashboard\Orders\OrderPayments\Invoices;

use App\Models\Order;
use Livewire\Component;


class Invoice extends Component
{

    public $order;
    public $orderPayment;
    public $customer;

    public string $invoiceFile = 'default-english';

    public function mount($order, $orderPayment): void
    {
        $this->invoiceFile = config('env.INVOICE_FILE');
        $this->order = Order::findOrFail($order);
        $this->orderPayment = $this->order->orderPayments->find($orderPayment);
        $this->customer = $this->order->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.order-payments.invoices.' . $this->invoiceFile)->extends('layouts.base')->section('content');
    }

}
