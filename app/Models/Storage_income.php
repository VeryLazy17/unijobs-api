<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Storage_income
 *
 * @property int $id
 * @property int $product_id
 * @property float $amount
 * @property float $price
 * @property float $total_price
 * @property float $waste_percentage
 * @property float $waste_amount
 * @property int $factory_id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereWasteAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereWastePercentage($value)
 * @mixin \Eloquent
 * @property float $percentage
 * @property-read Storage_income $storage_income
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income wherePercentage($value)
 * @property int $order_income_id
 * @property-read \App\Models\Order_income $order_income
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_income whereOrderIncomeId($value)
 */
class Storage_income extends Model
{
    protected $fillable = ['order_income_id', 'factory_id', 'order_id', 'product_id', 'percentage', 'amount', 'waste_amount', 'waste_percentage', 'total_price', 'price'];

    public function order_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order_income::class);
    }
}
