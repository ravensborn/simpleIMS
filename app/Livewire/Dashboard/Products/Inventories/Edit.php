<?php

namespace App\Livewire\Dashboard\Products\Inventories;

use App\Livewire\Forms\ProductInventoryForm;
use App\Models\Inventory;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public ProductInventoryForm $form;
    public Product $product;
    public Inventory $inventory;

    public function update(): void
    {
        $this->form->update($this->product->id);
        $this->redirectRoute('products.inventories.index', $this->product->id);
    }

    public function mount(Product $product, Inventory $inventory): void
    {
        $this->form->setup($inventory);
        $this->product = $product;
        $this->inventory = $inventory;
    }

    public function render()
    {
        return view('livewire.dashboard.Products.Inventories.edit')
            ->extends('layouts.base')
            ->section('content');
    }
}
