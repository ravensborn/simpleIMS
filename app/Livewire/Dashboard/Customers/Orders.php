<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination, LivewireAlert;
    public string $search = '';
    public Customer $customer;
    public function mount($customer): void
    {


    }
    public function render()
    {

        $orders = $this->customer->orders();

        if ($this->search) {
            $this->resetPage();
            $orders->where(function ($query) {
                    $query->where('number', 'LIKE', '%' . $this->search . '%')
                        ->orWhereHas('orderItems', function ($query) {
                            $query
                                ->where('product->name', 'LIKE', '%' . $this->search . '%');
                        });
                });
        }

        $orders = $orders->paginate(5);

        return view('livewire.dashboard.customers.orders', [
            'orders' => $orders,
        ])->extends('layouts.base')->section('content');
    }

}
