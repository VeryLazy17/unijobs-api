<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_income
 *
 * @property int $id
 * @property int $order_id
 * @property float $amount
 * @property float $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_income_extra_product[] $order_extra_income
 * @property-read int|null $order_extra_income_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Storage_income[] $order_storage_income
 * @property-read int|null $order_storage_income_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $order_income
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income search(?string $terms = null)
 */
class Order_income extends Model
{
    public function order_extra_income(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order_income_extra_product::class);
    }

    public function order_storage_income(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Storage_income::class);
    }

    public function order_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {

            $term = '%' . $term . '%';

            $query->where(function ($query) use ($term) {
                $query->where('amount', 'like', $term)
                    ->orWhereHas('order.factory', function ($query) use ($term) {
                        $query->where('name', 'like', $term);
                    })
                    ->orWhereHas('order.product', function ($query) use ($term) {
                        $query->where('name', 'like', $term)
                            ->orWhere('code', 'like', $term);
                    })
                    ->orWhereHas('order', function ($query) use ($term) {
                        $query->where('price', 'like', $term)
                            ->orWhere('color_code', 'like', $term);
                    });
            });
        });
    }
}
