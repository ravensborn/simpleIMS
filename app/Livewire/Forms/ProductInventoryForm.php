<?php

namespace App\Livewire\Forms;

use App\Models\Inventory;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProductInventoryForm extends Form
{
    public string|Inventory $model = Inventory::class;

    #[Rule('required|numeric', as: 'cost')]
    public string $cost = '';

    #[Rule('required|numeric', as: 'price')]
    public string $price = '';

    #[Rule('required|integer', as: 'quantity')]
    public string $quantity = '';

    #[Rule('required|date', as: 'date')]
    public string $date = '';

    #[Rule('nullable|string|max:100000', as: 'note')]
    public string|null $note = '';

    private array $attributes = ['cost', 'price', 'quantity', 'date', 'note'];


    public function setup($model): void
    {
        $this->model = $model;

        $this->cost = $model->cost;
        $this->price = $model->price;
        $this->quantity = $model->quantity;
        $this->date = $model->date;
        $this->note = $model->note;
    }

    public function store($productId): void
    {
        $this->validate();

        $product = Product::find($productId);

        $array = array_merge($this->only($this->attributes), [
            'product_id' => $productId,
            'number' => $this->model::generateNumber()
        ]);

        $model = new $this->model;
        $model = $model->create($array);

        $product->syncInventories();

        if(!$product->default_inventory_id) {
            $product->update([
                'default_inventory_id' => $model->id,
            ]);
        }

        $this->model = $product;
    }

    public function update(): void
    {
        $this->validate();
        $this->model->update($this->only($this->attributes));
        $this->model->product->syncInventories();
    }


}
