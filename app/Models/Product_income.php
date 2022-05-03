<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product_income
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $code
 * @property string|null $from_where
 * @property int $product_id
 * @property float $amount
 * @property float $price
 * @property float $total_cost
 * @property string $is_debt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereFromWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereIsDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereUpdatedAt($value)
 * @property float $total_price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product_income_payment[] $product_payments
 * @property-read int|null $product_payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product_income whereTotalPrice($value)
 * @property-read \App\Models\Product $product
 */
class Product_income extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'from_where', 'product_id', 'amount', 'price', 'total_price', 'is_debt'];

    public function product_payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product_income_payment::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
