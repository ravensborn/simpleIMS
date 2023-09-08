<?php

namespace App\Livewire\Dashboard\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public ProductForm $form;
    public Product $product;
    public bool $showCurrentImage = false;

    public function showCurrentImageToggle(): void
    {
        $this->showCurrentImage = true;
    }

    public function update(): void
    {
        $this->form->update();
        $this->redirectRoute('products.index');
    }

    public function mount(Product $product): void
    {
        $this->form->setup($product);
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.dashboard.products.edit')
            ->extends('layouts.base')
            ->section('content');
    }
}
