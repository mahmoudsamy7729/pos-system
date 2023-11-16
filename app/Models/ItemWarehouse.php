<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemWarehouse extends Model
{
    use HasFactory;
    protected $table = 'item_warehouse';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'item_name',
        'warehouse_id',
        'quantity',
    ];
}
