<?php

namespace App\Livewire\Dashboard\Customers;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Component;

class Edit extends Component
{
    public CustomerForm $form;
    public Customer $customer;

    public function update(): void
    {
        $this->form->update();
        $this->redirectRoute('customers.index');
    }

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
        $this->form->setup($customer);
    }

    public function render()
    {
        return view('livewire.dashboard.customers.edit')
            ->extends('layouts.base')
            ->section('content');
    }
}
