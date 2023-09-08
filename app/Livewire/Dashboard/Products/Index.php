<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
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

        $product = Product::find($this->itemIdToBeDeleted);

        if ($product) {

            $product->delete();

            $this->alert('success', 'Item successfully deleted.', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);

        }
    }

    public function render()
    {

        $products = Product::orderBy('created_at', 'desc');

        if ($this->search) {
            $products = $products->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('number', 'LIKE', '%' . $this->search . '%');
        }

        $products = $products->paginate(5);

        return view('livewire.dashboard.products.index', [
            'products' => $products,
        ])->extends('layouts.base')->section('content');
    }

}
