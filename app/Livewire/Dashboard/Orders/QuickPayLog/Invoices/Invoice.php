<?php

namespace App\Livewire\Dashboard\Orders\QuickPayLog\Invoices;

use App\Models\Customer;
use App\Models\QuickPayLog;
use Livewire\Component;


class Invoice extends Component
{

    public QuickPayLog $log;
    public Customer $customer;
    public string $invoiceFile = 'default-english';

    public function mount(QuickPayLog $quickPayLog): void
    {
        $this->invoiceFile = config('env.INVOICE_FILE');
        $this->log = $quickPayLog;
        $this->customer = $quickPayLog->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.quick-pay-log.invoices.' . $this->invoiceFile)
            ->extends('layouts.base')
            ->section('content');
    }

}
