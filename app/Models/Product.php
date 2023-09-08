<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    protected $casts = [
        'properties' => 'array'
    ];

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 500, 500)
            ->nonQueued();
    }

    public function inventories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function defaultInventory(): ?Inventory
    {
        return $this->inventories->where('id', $this->default_inventory_id)->first();
    }

    public function isDefaultInventory($inventoryId): bool
    {

        return ($this->defaultInventory()?->id == $inventoryId);
    }

    public function getDefaultInventoryQuantity()
    {
        return $this->defaultInventory()?->quantity ?? 0;
    }

    public function syncInventories(): void
    {
        $sum = 0;

        foreach ($this->inventories as $item) {
            $sum = $sum + $item->quantity;
        }

        $this->update([
            'available_inventory' => $sum,
        ]);
    }

    public function getCover($conversionName = null): string
    {
        $media = $this->getFirstMedia('image');

        if($media) {
            if($conversionName) {
                return $media->getUrl($conversionName);
            }

            return $media->getUrl();
        }

        return asset('images/cardboard-box.png');
    }

    public static function generateNumber(): string
    {

        $lastProduct =  self::orderBy('id', 'DESC')->first();
        $lastProductId = $lastProduct ? $lastProduct->id : 0;

        $prefix = strtoupper(config('env.SYS_PRODUCT_PREFIX') . '_');
        $last = $lastProductId;
        $next = 1 + $last;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
