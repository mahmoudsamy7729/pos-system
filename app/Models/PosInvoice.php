<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosInvoice extends Model
{
    use HasFactory;
    protected $table = 'pos_invoice';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'customer_id',
        'biller_id',
        'invoice_code',
        'quantity',
        'subtotal',
        'discount',
        'shipping',
        'total',
        'paid',
        'status',
        'warehouse_id',
        'session_code',
    ];
    protected $dates = [
        'date',
    ];  
    public function biller()
    {
        return $this->hasOne(User::class,'id','biller_id');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }
    public function products()
    {
        return $this->belongsToMany(Item::class,PosInvoiceProducts::class,'invoice_id','product_id')->withPivot('quantity','price');
    }
    public function getRouteKeyName()
{
    return 'invoice_code';
}
}
