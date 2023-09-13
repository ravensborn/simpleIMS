<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\Customer;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = [
        'deleteItem',
    ];

    public int $itemIdToBeDeleted = 0;

    public string $search = '';


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

        $customer = Customer::find($this->itemIdToBeDeleted);

        if($customer) {

            // TODO: check user for orders before deleting.

            $customer->delete();
        }

        $this->alert('success', 'Item successfully deleted.', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);
    }

    public function render()
    {

        $customers = Customer::orderBy('created_at', 'desc');

        if ($this->search) {
            $this->resetPage();
            $customers = $customers->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $this->search . '%');
        }

        $customers = $customers->paginate(5);

        return view('livewire.dashboard.customers.index', [
            'customers' => $customers,
        ])->extends('layouts.base')->section('content');
    }

}
