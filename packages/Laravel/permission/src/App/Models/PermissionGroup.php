<?php

namespace Laravel\Permission\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PermissionGroup extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = ['name'];

    protected $casts = [
        'permission_ids' => 'array'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('permission')
            ->logOnlyDirty();
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
