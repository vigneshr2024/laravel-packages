<?php

namespace Laravel\Permission\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Permission extends SpatiePermission
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = ['name', 'permission_group_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('permission')
            ->logOnlyDirty();
    }
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
