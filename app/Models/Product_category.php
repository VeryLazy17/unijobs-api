<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product_category
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product_category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 */
class Product_category extends Model
{
    protected $fillable = ['parent_id', 'name', 'description'];

    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
