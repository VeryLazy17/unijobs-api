<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sewing_report
 *
 * @property int $id
 * @property int $product_id
 * @property float $amount
 * @property float $amount_using
 * @property float $amount_sewed
 * @property float $percentage
 * @property float $waste_percentage
 * @property float $waste_amount
 * @property float $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereAmountSewed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereAmountUsing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereWasteAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereWastePercentage($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sewing_payment[] $sewing_payments
 * @property-read int|null $sewing_payments_count
 * @property string $is_debt
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereIsDebt($value)
 * @property string|null $color
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_report whereColor($value)
 */
class Sewing_report extends Model
{
    protected $fillable = ['color', 'amount_using', 'product_id', 'amount', 'amount_sewed', 'total_price', 'waste_percentage','waste_amount','is_debt'];

    public function sewing_payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Sewing_payment::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
