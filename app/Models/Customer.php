<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'properties' => 'array'
    ];

    protected $appends = ['amount_due'];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getAmountDueAttribute() {

        return $this->orders->sum(function ($order) {
            return $order->amount_due;
        });

    }
}
