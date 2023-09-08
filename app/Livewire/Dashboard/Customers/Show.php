<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Customer;
use Livewire\Component;

class Show extends Component
{
    public Customer $customer;

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function render()
    {

        return view('livewire.dashboard.customers.show')
            ->extends('layouts.base')
            ->section('content');
    }
}
