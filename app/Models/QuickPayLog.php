<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuickPayLog extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'orders' => 'object'
    ];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public static function generateNumber(): string
    {

        $lastProduct =  self::orderBy('id', 'DESC')->first();
        $lastProductId = $lastProduct ? $lastProduct->id : 0;

        $prefix = strtoupper(config('env.SYS_QUICK_PAY_PREFIX') . '_');
        $last = $lastProductId;
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
