<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Factory_income
 *
 * @property int $id
 * @property int $factory_id
 * @property int $product_id
 * @property float $amount
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Factory $factory
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income search(?string $terms = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_income test($search)
 */
class Factory_income extends Model
{
    protected $fillable = ['factory_id', 'product_id', 'amount', 'order_id', 'created_at'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function factory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Factory::class);
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

    public function scopeTest($query, $search)
    {
        $query->whereHas('factory', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }
}
