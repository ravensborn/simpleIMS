<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{

    public array $cards = [];

    public function loadCards(): void
    {

        $orders = Order::all();
        $customers = Customer::all();
        $products = Product::all();

        $this->cards[] = [
            'title' => 'Orders',
            'data' => $orders->count(),
        ];

        $this->cards[] = [
            'title' => 'Orders Pending',
            'data' => $orders->whereIn('status', [Order::STATUS_PENDING, Order::STATUS_INITIAL])->count(),
        ];

        $this->cards[] = [
            'title' => 'Orders Completed',
            'data' => $orders->where('status', Order::STATUS_COMPLETED)->count(),
        ];

        $this->cards[] = [
            'title' => 'Amount Due',
            'data' => '$' . number_format($orders->sum('amount_due'), 2),
        ];

        $this->cards[] = [
            'title' => 'Products',
            'data' => $products->count(),
        ];

        $this->cards[] = [
            'title' => 'Customers',
            'data' => $customers->count(),
        ];





    }

    public function mount(): void
    {
//        $this->loadCards();
    }

    public function render()
    {
        return view('livewire.dashboard.home')
            ->extends('layouts.base')
            ->section('content');
    }
}
