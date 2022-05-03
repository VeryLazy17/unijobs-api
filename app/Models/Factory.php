<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Factory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $factory_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Factory_category $factory_category
 * @method static \Illuminate\Database\Eloquent\Builder|Factory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereFactoryCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Factory extends Model
{

    protected $fillable = ['factory_category_id', 'created_at', 'description', 'name'];

    public function factory_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Factory_category::class);
    }
}
