<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = [
        'deleteItem',
    ];

    public string $search = '';
    public int $itemIdToBeDeleted = 0;

    public Customer $customer;
    public function mount($customer): void
    {
    }

    public function triggerDeleteItem($item): void
    {
        $this->confirm('Are you sure that you want to delete this item?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'deleteItem'
        ]);

        $this->itemIdToBeDeleted = $item;

    }

    public function deleteItem(): void
    {

        $order = Order::find($this->itemIdToBeDeleted);

        if ($order) {

            $order->delete();

            $this->alert('success', 'Item successfully deleted.', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);

        }
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

        $orders = $orders->paginate(10);

        return view('livewire.dashboard.customers.orders', [
            'orders' => $orders,
        ])->extends('layouts.base')->section('content');
    }

}
