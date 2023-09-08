<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['properties' => 'array', 'date' => 'date'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function generateNumber(): string
    {
        $lastInventory =  self::orderBy('id', 'DESC')->first();
        $lastInventoryId = $lastInventory ? $lastInventory->id : 0;

        $prefix = strtoupper(config('env.SYS_INVENTORY_PREFIX') . '_');
        $last = $lastInventoryId;
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
