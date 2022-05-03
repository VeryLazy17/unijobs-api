<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Factory_product
 *
 * @property int $id
 * @property int $factory_id
 * @property int $product_id
 * @property float $amount
 * @property string $product_case
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereProductCase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Factory $factory
 * @property-read \App\Models\Product $product
 */
class Factory_product extends Model
{
    protected $fillable = ['amount', 'created_at', 'factory_id', 'product_id', 'product_case'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function factory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Factory::class);
    }
}
