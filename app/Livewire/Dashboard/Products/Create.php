<?php

namespace App\Livewire\Dashboard\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use LivewireAlert, WithFileUploads;

    public ProductForm $form;

    public function store(): void
    {
        $this->form->store();
        $this->redirectRoute('products.index');
    }

    public function mount(): void
    {
    }

    public function render()
    {
        return view('livewire.dashboard.products.create')
            ->extends('layouts.base')
            ->section('content');
    }
}
