<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Customer;
use Livewire\Component;


class PrintDetails extends Component
{

    public Customer $customer;

    public function mount($customer): void
    {

    }

    public function render()
    {

        return view('livewire.dashboard.customers.print-details')->extends('layouts.base')->section('content');
    }

}
