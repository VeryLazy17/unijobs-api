<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product_income_payment
 *
 * @property int $id
 * @property int $product_income_id
 * @property float $sum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment whereProductIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income_payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Product_income $product_income
 */
class Product_income_payment extends Model
{
    protected $fillable = ['product_income_id', 'sum'];

    public function product_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product_income::class);
    }
}
