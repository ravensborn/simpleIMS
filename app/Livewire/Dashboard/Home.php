<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Home extends Component
{
    use LivewireAlert;

    public array $cards = [];

    public function loadCards(): void
    {

        $orders = Order::all();
        $customers = Customer::all();
        $products = Product::all();
        $inventories = Inventory::all();

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

        $this->cards[] = [
            'title' => 'Inventory Cost',
            'data' => '$' . number_format($inventories->sum(function ($inventory) {
                    return $inventory->cost * $inventory->quantity;
                }), 2),
        ];

        $this->cards[] = [
            'title' => 'Daily Cash Received',
            'data' => '$' . number_format($orders->filter(function ($order) {
                    return $order->created_at->isToday();
                })->sum('paid'), 2),
        ];

        $this->cards[] = [
            'title' => 'Daily Dept Received',
            'data' => '$' . number_format($orders->filter(function ($order) {
                    return $order->created_at->isBefore(today());
                })->sum(function ($order) {
                    return $order->orderPayments()->whereDate('created_at', today())->sum('amount');
                }), 2),
        ];


        $this->cards[] = [
            'title' => 'Monthly Cash Received',
            'data' => '$' . number_format($orders->whereBetween('created_at', [
                    today()->startOfMonth(),
                    today()->endOfMonth(),
                ])->sum('paid'), 2),
        ];

        $this->cards[] = [
            'title' => 'Last Year Profit',
            'data' => '$' . number_format($orders->filter(function ($order) {
                    return $order->created_at->isLastYear();
                })->sum(function ($order) {
                    return $order->profit();
                }), 2),
        ];

        $this->cards[] = [
            'title' => 'Total Profit',
            'data' => '$' . number_format($orders->sum(function ($order) {
                    return $order->profit();
                }), 2),
        ];

        $this->cards[] = [
            'title' => 'Daily Profit',
            'data' => '$' . number_format($orders->filter(function ($order) {
                    return $order->created_at->isToday();
                })->sum(function ($order) {
                    return $order->profit();
                }), 2),
        ];

        $this->cards[] = [
            'title' => 'Monthly Profit',
            'data' => '$' . number_format($orders->whereBetween('created_at', [
                    today()->startOfMonth(),
                    today()->endOfMonth(),
                ])->sum(function ($order) {
                    return $order->profit();
                }), 2),
        ];

    }

    public function reSyncOrderStatuses(): void
    {

        Order::all()->each(function ($order) {
            $order->syncPayments();
        });

        $this->alert('info', 'Finished syncing orders.');
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
