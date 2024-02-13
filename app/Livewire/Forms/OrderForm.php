<?php

namespace App\Livewire\Forms;

use App\Models\Order;
use Livewire\Attributes\Rule;
use Livewire\Form;

class OrderForm extends Form
{
    public string|Order $model = Order::class;

    #[Rule('required|numeric|exists:customers,id', as: 'customer')]
    public string $customer_id = '';

    #[Rule('nullable|string|max:100000', as: 'note')]
    public string|null $note = '';

    private array $attributes = ['customer_id', 'note'];


    public function setup($model): void
    {
        $this->model = $model;

        $this->customer_id = $model->customer_id;
        $this->note = $model->note;
    }

    public function store(): void
    {
        $this->validate();

        $model = new $this->model;

        $array = array_merge($this->only($this->attributes), [
            'user_id' => auth()->user()->id,
            'number' => $this->model::generateNumber()
        ]);

        $this->model = $model->create($array);
    }

    public function update(): void
    {
        $this->validate();

        $this->model?->update($this->only($this->attributes));
    }


}
