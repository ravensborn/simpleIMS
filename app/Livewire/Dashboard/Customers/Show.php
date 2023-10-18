<?php

namespace App\Livewire\Dashboard\Customers;

use App\Livewire\Forms\OrderPaymentForm;
use App\Models\Customer;
use App\Models\Order;
use App\Models\QuickPayLog;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Show extends Component
{
    use LivewireAlert, WithPagination;

    public Customer $customer;

    public int $customerProfit = 0;

    public bool $customerQuickPayCard = false;

    public bool $showProfit = false;
    public string $payAmount;
    public OrderPaymentForm $orderPaymentForm;

    public function showCustomerPayCard(): void
    {
        $this->customerQuickPayCard = !$this->customerQuickPayCard;
        $this->payAmount = '';
    }

    public function showCustomerProfit() {
        $this->showProfit = !$this->showProfit;
    }

    public function payCustomerDueAmount(): void
    {
        $validated = $this->validate([
            'payAmount' => 'required|numeric'
        ]);

        $payAmount = $validated['payAmount'];

        $fulfilledOrders = collect();

        if ($payAmount <= $this->customer->amount_due) {

            $unfulfilledOrders = $this->customer->orders()->whereIn('status', [
                Order::STATUS_INITIAL, Order::STATUS_PENDING
            ])->get();

            foreach ($unfulfilledOrders as $order) {

                $amountDue = $order->amount_due;

                $this->orderPaymentForm->order_id = $order->id;

                if ($payAmount > 0) {
                    $this->orderPaymentForm->amount = min($payAmount, $amountDue);
                    $payAmount -= $this->orderPaymentForm->amount;
                    $this->orderPaymentForm->store();
                    $order->syncPayments();

                    $fulfilledOrders->push([
                        'order' => $order,
                        'payment' => $this->orderPaymentForm->model,
                    ]);

                } else {
                    break;
                }
            }

            $customerAmountDue = $this->customer->amount_due;
            $this->customer->quickPayLogs()->create([
                'number' => QuickPayLog::generateNumber(),
                'orders' => $fulfilledOrders,
                'amount_due_before_payment' => $customerAmountDue,
                'amount_paid' => $this->payAmount,
                'remaining' => $customerAmountDue - $this->payAmount,
            ]);


            $this->payAmount = '';
            $this->customerQuickPayCard = false;

            $this->getProfit();
            $this->customer = Customer::find($this->customer->id);

            $this->alert('success', 'Successfully added payments.');

        } else {

            $this->alert('error', 'Pay amount cannot be more than customer amount due.');
        }
    }

    public function mount(Customer $customer): void
    {
    }

    public function getProfit(): void
    {
        $this->customerProfit = $this->customer->profit();
    }

    public function render()
    {

        $quickPayLogs = $this->customer->quickPayLogs()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.dashboard.customers.show', [
            'quickPayLogs' => $quickPayLogs
        ])
            ->extends('layouts.base')
            ->section('content');
    }
}
