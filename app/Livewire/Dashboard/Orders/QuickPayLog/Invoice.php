<?php

namespace App\Livewire\Dashboard\Orders\QuickPayLog;

use App\Models\Customer;
use App\Models\QuickPayLog;
use Livewire\Component;


class Invoice extends Component
{

    public QuickPayLog $log;
    public Customer $customer;

    public function mount(QuickPayLog $quickPayLog): void
    {

       $this->log = $quickPayLog;
       $this->customer = $quickPayLog->customer;
    }

    public function render()
    {

        return view('livewire.dashboard.orders.quick-pay-log.invoice')
            ->extends('layouts.base')
            ->section('content');
    }

}
