<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $code
 * @property int $factory_id
 * @property int $product_id
 * @property int|null $color_code
 * @property float $amount
 * @property float $price
 * @property float $total_price
 * @property string $type
 * @property string $status
 * @property string $is_debt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereColorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Factory $factory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_payment[] $order_payments
 * @property-read int|null $order_payments_count
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_income[] $order_incomes
 * @property-read int|null $order_incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order_extra_product[] $order_extra_product
 * @property-read int|null $order_extra_product_count
 * @property-read \App\Models\Factory_income $factory_income
 * @method static \Illuminate\Database\Eloquent\Builder|Order search(?string $terms = null)
 */
class Order extends Model
{

    protected $fillable = ['status', 'code', 'factory_id', 'product_id', 'color_code', 'amount', 'price', 'total_price', 'type'];

    public function order_payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order_payment::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function factory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Factory::class);
    }

    public function order_incomes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order_income::class);
    }

    public function order_extra_product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order_extra_product::class);
    }

    public function factory_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Factory_income::class);
    }

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {

            $term = '%' . $term . '%';

            $query->where(function ($query) use ($term) {
                $query->where('code', 'like', $term)
                    ->orWhere('color_code', 'like', $term)
                    ->orWhere('amount', 'like', $term)
                    ->orWhere('price', 'like', $term)
                    ->orWhere('total_price', 'like', $term)
                    ->orWhereHas('factory', function ($query) use ($term) {
                        $query->where('name', 'like', $term);
                    })
                    ->orWhereHas('product', function ($query) use ($term) {
                        $query->where('name', 'like', $term)
                            ->orWhere('code', 'like', $term);
                    });
            });
        });
    }
}
