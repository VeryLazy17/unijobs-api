<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sewing_payment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $sewing_report_id
 * @property float $sum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment whereSewingReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sewing_payment whereUpdatedAt($value)
 * @property-read \App\Models\Sewing_report $sewing_income
 * @property-read \App\Models\Sewing_report $sewing_report
 */
class Sewing_payment extends Model
{
    protected $fillable = ['sewing_report_id', 'sum'];

    public function sewing_income(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sewing_report::class);
    }

    public function sewing_report(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sewing_report::class);
    }
}
