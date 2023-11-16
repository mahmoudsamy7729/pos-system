<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'sell_unit',
        'purchase_unit',
        'qty_purchase_unit',
        'min_quantity',
        'barcode',
        'expire_date',
        'description',
        'image',
        'purchase_price',
        'sales_price',
        'profit_margin',
        'active',
        'created_by',
        'created_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
    public function category()
    {
        return $this->hasOne(ItemCategory::class,'id','category_id');
    }

    public function warehouse_quantity()
    {
        return $this->hasMany(ItemWarehouse::class,'item_name','name');
    }

}
