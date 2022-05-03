<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order_income_extra_product
 *
 * @property int $id
 * @property int $order_income_id
 * @property int $product_id
 * @property float $percentage
 * @property float $amount
 * @property float $waste_percentage
 * @property float $waste_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereOrderIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereWasteAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order_income_extra_product whereWastePercentage($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Order_income $order_income
 */
class Order_income_extra_product extends Model
{

    protected $fillable = ['order_income_id','product_id','percentage','amount','waste_amount','waste_percentage'];

    public function order_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order_income::class);
    }
}
