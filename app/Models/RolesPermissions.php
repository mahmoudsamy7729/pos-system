<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesPermissions extends Model
{
    use HasFactory;
    protected $table = 'roles_permissions';
    public $timestamps = false;
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    public function permissionName()
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }
}
