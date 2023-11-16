<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsCategories extends Model
{
    use HasFactory;
    protected $table = 'permissions_categories';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
    ];
    public function permissions()
    {
        return $this->hasMany(Permission::class,'category_id','id');
    }

}
