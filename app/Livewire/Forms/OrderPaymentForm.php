<?php

namespace App\Livewire\Forms;

use App\Models\OrderPayment;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;

class OrderPaymentForm extends Form
{
    public string|OrderPayment $model = OrderPayment::class;

    #[Locked]
    public string $order_id = '';

    #[Rule('required|numeric|gt:0', as: 'amount')]
    public string $amount = '';

    private array $attributes = ['amount'];

    public function store(): void
    {
        $this->validate();
        $model = new $this->model;

        $array = array_merge($this->only($this->attributes), [
            'order_id' => $this->order_id,
            'number' => $this->model::generateNumber(),
        ]);

        $model->create($array);
    }

}
