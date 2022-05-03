<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Debtor
 *
 * @property int $id
 * @property int $client_id
 * @property float $total_debt
 * @property float $total_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereTotalDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereTotalPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Client $client
 */
class Debtor extends Model
{
    protected $fillable = ['client_id', 'created_at', 'total_paid','total_debt'];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function payment_history(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Debtor_history_payment::class);
    }
}
