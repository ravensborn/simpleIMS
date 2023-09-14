<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'properties' => 'array',
    ];

    protected $appends = ['amount_due'];

    const STATUS_INITIAL = 'initial';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    public static function statusArray(): array
    {
        return [
            self::STATUS_INITIAL,
            self::STATUS_PENDING,
            self::STATUS_COMPLETED,
        ];
    }

    public function getBadgeColorByStatus(): string
    {
        return match ($this->status) {
            self::STATUS_INITIAL => 'badge bg-orange-lt',
            self::STATUS_PENDING => 'badge bg-yellow-lt',
            self::STATUS_COMPLETED => 'badge bg-cyan-lt',
            default => 'badge bg-azure-lt',
        };

    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class)->orderBy('created_at', 'desc');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderPayments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderPayment::class)->orderBy('created_at', 'desc');
    }

    public function getAmountDueAttribute() {

        return $this->total - $this->paid;
    }

    public function profit(): int {
        return $this->orderItems->sum(function ($item) {
            return $item->profit();
        });
    }

    public function syncTotal(): void
    {
        $sum = 0;

        foreach ($this->orderItems as $item) {
            $sum = $sum + ($item->price * $item->quantity);
        }

        $this->update([
            'total' => $sum,
        ]);
    }

    public function syncPayments(): void
    {
        $sum = 0;

        foreach ($this->orderPayments as $item) {
            $sum = $sum + $item->amount;
        }

        if($sum != $this->total) {
            $status = self::STATUS_PENDING;
        } else {
            $status = self::STATUS_COMPLETED;
        }

        $this->update([
            'status' => $status,
            'paid' => $sum,
        ]);
    }

    public static function generateNumber(): string
    {
        $lastCustomer =  self::orderBy('id', 'DESC')->first();
        $lastCustomerId = $lastCustomer ? $lastCustomer->id : 0;

        $prefix = strtoupper(config('env.SYS_ORDER_PREFIX') . '_');
        $last = $lastCustomerId;
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
