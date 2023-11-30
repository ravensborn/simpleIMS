<?php

namespace App\Livewire\Dashboard\Orders;

use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public array $orderProfitList = [];

    protected $listeners = [
        'deleteItem',
    ];

    public int $itemIdToBeDeleted = 0;

    public string $search = '';

    public function processOrderProfit($orderId): void
    {
        $order = Order::find($orderId);

        $this->orderProfitList[$order->id] = $order->profit();
    }

    public function getOrderProfit($orderId) {

        return $this->orderProfitList[$orderId];
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
        $orders = Order::with('customer')->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $orders->where('number', 'LIKE', '%' . $this->search . '%')
                ->orWhereHas('customer', function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                })
                ->orWhereHas('customer', function ($query) {
                    $query->where('phone_number', 'LIKE', '%' . $this->search . '%');
                });
        }

        $orders = $orders->paginate(10);

        return view('livewire.dashboard.orders.index', [
            'orders' => $orders,
        ])->extends('layouts.base')->section('content');
    }

}
