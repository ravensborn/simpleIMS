<?php

namespace App\Livewire\Dashboard\Orders\Invoices;

use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;


class Invoice extends Component
{

    public Order $order;

    public Customer $customer;

    public string $invoiceFile = 'default-english';

    public function mount($order): void
    {
        $this->invoiceFile = config('env.INVOICE_FILE');
        $this->order = $order;
        $this->customer = $this->order->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.invoices.' . $this->invoiceFile)->extends('layouts.base')->section('content');
    }

}
