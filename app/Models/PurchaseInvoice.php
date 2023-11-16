<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    protected $table = 'purchase_invoice';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'supplier_id',
        'user_id',
        'invoice_code',
        'quantity',
        'subtotal',
        'discount',
        'shipping',
        'total',
        'warehouse_id',
    ];
    protected $dates = [
    'date',
    ];  
    public function supplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }
    public function products()
    {
        return $this->belongsToMany(Item::class,PurchaseInvoiceProducts::class,'invoice_id','product_id')->withPivot('quantity','price');
    }
    public function payments()
    {
        return $this->hasMany(Payments::class, 'invoice_id', 'id');

    }
}
