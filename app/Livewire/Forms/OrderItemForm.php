<?php

namespace App\Livewire\Forms;

use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;

class OrderItemForm extends Form
{
    public string|OrderItem $model = OrderItem::class;

    #[Rule('required|numeric|exists:orders,id', as: 'order')]
    public string $order_id = '';

    #[Rule('required|numeric|exists:products,id', as: 'product')]
    public string $product_id = '';

    #[Rule('required|numeric|exists:inventories,id', as: 'inventory')]
    public string $inventory_id = '';

    #[Rule('required|numeric', as: 'price')]
    public string $price = '';

    #[Rule('required|integer', as: 'quantity')]
    public string $quantity = '';

    #[Locked]
    public Product|null $product = null;
    #[Locked]
    public Inventory|null $inventory = null;

    private array $attributes = ['order_id', 'product_id', 'inventory_id', 'price', 'quantity'];

    public function resetInputs(): void
    {
        $this->order_id = '';
        $this->product_id = '';
        $this->inventory_id = '';
        $this->price = '';
        $this->quantity = 1;
    }

    public function setup($model): void
    {
        $this->model = $model;
    }

    public function store(): void
    {
        $this->validate();

        $model = new $this->model;

        $array = array_merge($this->only($this->attributes), [
            'inventory' => $this->inventory,
            'product' => $this->product,
        ]);

        $model = $model->create($array);

        $this->inventory->decrement('quantity',  $model->quantity);
        $this->product->syncInventories();
        $this->product->increment('times_sold');

        $this->model = $model;
    }

}
