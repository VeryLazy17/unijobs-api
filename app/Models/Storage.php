<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Storage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $storage_type_id
 * @property int $product_id
 * @property string|null $color
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereStorageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereUpdatedAt($value)
 * @property-read \App\Models\Product $product
 * @property string $product_case
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereProductCase($value)
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|Storage wherePrice($value)
 */
class Storage extends Model
{
    use HasFactory;

    protected $fillable = ['storage_type_id', 'product_id', 'color', 'amount','product_case','price'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
