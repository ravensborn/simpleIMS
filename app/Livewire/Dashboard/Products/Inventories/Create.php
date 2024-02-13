<?php

namespace App\Livewire\Dashboard\Products\Inventories;

use App\Livewire\Forms\ProductInventoryForm;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use LivewireAlert, WithFileUploads;

    public Product $product;

    public ProductInventoryForm $form;

    public function store(): void
    {
        $this->form->store($this->product->id);
        $this->redirectRoute('products.inventories.index', $this->product->id);
    }

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.dashboard.products.inventories.create')
            ->extends('layouts.base')
            ->section('content');
    }
}
