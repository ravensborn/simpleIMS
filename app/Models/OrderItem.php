<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'product' => 'object',
        'inventory' => 'object',
        'properties' => 'array',
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function inventory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    public function profit(): int
    {
        $inventory = $this->getAttribute('inventory');


        $cost = 0;

        if (property_exists($inventory, 'cost')) {
            $cost = $inventory->cost;

        }

        return ($this->price - $cost) * $this->quantity;
    }
}
