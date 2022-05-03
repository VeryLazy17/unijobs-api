<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $action
 * @property string $subject
 * @property int|null $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Role|null $role
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $section
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSection($value)
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['sidebar', 'navbar', 'warehouse_thread', 'warehouse_material', 'warehouse_collar', 'role_id'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getActionAttribute($value)
    {
        return explode('|', $value);
    }

}
