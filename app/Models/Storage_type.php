<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Storage_type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage_type whereUpdatedAt($value)
 */
class Storage_type extends Model
{
    protected $fillable = ['name', 'type', 'description'];
}
