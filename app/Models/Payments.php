<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'invoice_id',
        'payment_code',
        'supplier_id',
        'amount',
        'user_id',
        'date',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
    public function supplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function invoice()
    {
        return $this->hasOne(PurchaseInvoice::class,'id','invoice_id');
    }
    
}
