<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CustomerForm extends Form
{
    public string|Customer $model = Customer::class;

    #[Rule('required|string|max:256', as: 'name')]
    public string $name = '';

    #[Rule('nullable|string|max:256', as: 'phone number')]
    public string $phone_number = '';

    #[Rule('nullable|email|string|max:256', as: 'email address')]
    public string|null $email_address = '';

    #[Rule('nullable|string|max:256', as: 'address')]
    public string $address = '';

    #[Rule('nullable|string|max:100000', as: 'note')]
    public string|null $note = '';

    private array $attributes = ['name', 'phone_number', 'email_address', 'address', 'note'];


    public function setup($model): void
    {
        $this->model = $model;

        $this->name = $model->name;
        $this->phone_number = $model->phone_number;
        $this->email_address = $model->email_address;
        $this->address = $model->address;
        $this->note = $model->note;
    }

    public function store(): void
    {
        $this->validate();
        $model = new $this->model;
        $this->model = $model->create($this->only($this->attributes));
    }

    public function update(): void
    {
        $this->validate();
        $this->model?->update($this->only($this->attributes));
    }


}
