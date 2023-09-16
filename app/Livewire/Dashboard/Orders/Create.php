<?php

namespace App\Livewire\Dashboard\Orders;

use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;

class Create extends Component
{

    public OrderForm $form;

    public array $suggestedCustomers = [];
    public bool $suggestedCustomersSelectBox = false;
    public string $customerSearchQuery = '';
    public string $selectedCustomerString = '';

    public function updatedCustomerSearchQuery(): void
    {
        $this->resetValidation();

        if($this->customerSearchQuery) {

            if($this->customerSearchQuery == 'd.') {

                $this->suggestedCustomers = Customer::orderBy('name')
                    ->get()
                    ->toArray();

            } else {
                $this->suggestedCustomers = Customer::where('name', 'LIKE', '%' . $this->customerSearchQuery. '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $this->customerSearchQuery. '%')
                    ->limit(5)
                    ->get()
                    ->toArray();
            }

        } else {

            $this->suggestedCustomers = [];
        }

        $this->suggestedCustomersSelectBox = true;
    }

    public function selectCustomer($customerId): void
    {
        $customer = Customer::find($customerId);
        $this->form->customer_id = $customer->id;
        $this->selectedCustomerString = $customer->name;
        $this->suggestedCustomersSelectBox = false;
    }

    public function store(): void
    {
        $this->form->store();
        $this->redirectRoute('orders.index');
    }

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.dashboard.orders.create')
            ->extends('layouts.base')
            ->section('content');
    }
}
