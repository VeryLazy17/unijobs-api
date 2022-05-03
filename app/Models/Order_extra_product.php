<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_extra_product
 *
 * @property int $id
 * @property int $product_id
 * @property float $amount
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_extra_product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 */
class Order_extra_product extends Model
{
    protected $fillable = ['order_id', 'product_id', 'amount'];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
