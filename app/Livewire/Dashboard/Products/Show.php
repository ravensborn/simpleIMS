<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {

        $this->product = $product;
    }

    public function render()
    {

        return view('livewire.dashboard.products.show')
            ->extends('layouts.base')
            ->section('content');
    }
}
