<?php

namespace App\Livewire\Dashboard\Customers;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{

    public CustomerForm $form;

    public function store(): void
    {
        $this->form->store();
        $this->redirectRoute('customers.index');
    }

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.dashboard.customers.create')
            ->extends('layouts.base')
            ->section('content');
    }
}
