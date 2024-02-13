<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function generateNumber(): string
    {
        $lastItem =  self::orderBy('id', 'DESC')->first();
        $lastItemId = $lastItem ? $lastItem->id : 0;

        $prefix = strtoupper(config('env.SYS_PAYMENT_PREFIX') . '_');
        $last = $lastItemId;
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
