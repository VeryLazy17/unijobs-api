<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Debtor_history_payment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $debtor_id
 * @property float $sum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment whereDebtorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor_history_payment whereUpdatedAt($value)
 */
class Debtor_history_payment extends Model
{
    protected $fillable = ['debtor_id', 'sum','created_at'];
}
