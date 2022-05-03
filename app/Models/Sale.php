<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sale
 *
 * @property int $id
 * @property int $product_id
 * @property string $customer
 * @property float $amount
 * @property float $price
 * @property float $total_price
 * @property string $is_debt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereIsDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sale_payment[] $sale_payments
 * @property-read int|null $sale_payments_count
 * @property int $client_id
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereClientId($value)
 * @property-read \App\Models\Client $client
 */
class Sale extends Model
{

    protected $fillable = ['amount', 'client_id', 'created_at', 'is_debt', 'price', 'product_id', 'total_price'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
