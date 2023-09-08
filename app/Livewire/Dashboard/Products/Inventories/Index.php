<?php

namespace App\Livewire\Dashboard\Products\Inventories;

use App\Models\Inventory;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public Product $product;

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

        $inventory = $this->product->inventories()->find($this->itemIdToBeDeleted);

        if ($inventory) {

            if($this->product->isDefaultInventory($inventory->id)) {

                $this->alert('error', 'Cannot delete default inventory.', [
                    'position' => 'top-end',
                    'timer' => 5000,
                    'toast' => true,
                ]);

            } else {

                $inventory->delete();

                $this->alert('success', 'Item successfully deleted.', [
                    'position' => 'top-end',
                    'timer' => 5000,
                    'toast' => true,
                ]);

            }
        }

        Product::find($this->product->id)->syncInventories();
    }

    public function setInventoryAsDefault($inventoryId): void
    {
        $this->product->update([
            'default_inventory_id' => $inventoryId
        ]);
    }

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function render()
    {

        $inventories = $this->product
            ->inventories()
            ->orderBy('created_at', 'desc');


        $inventories = $inventories->paginate(10);

        return view('livewire.dashboard.products.inventories.index', [
            'inventories' => $inventories,
        ])->extends('layouts.base')->section('content');
    }

}
