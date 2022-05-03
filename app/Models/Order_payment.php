<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_payment
 *
 * @property int $id
 * @property int $order_id
 * @property float $sum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order $order_income
 * @property-read \App\Models\Order $order
 */
class Order_payment extends Model
{
    protected $fillable = ['order_id', 'sum'];

    public function order_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
