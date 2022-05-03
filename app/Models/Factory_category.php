<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Factory_category
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Factory[] $factory
 * @property-read int|null $factory_count
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Factory_category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Factory_category extends Model
{

    public function factory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Factory::class);
    }
}
