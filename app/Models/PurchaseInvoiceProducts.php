<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoiceProducts extends Model
{
    use HasFactory;
    protected $table = 'purchase_invoice_products';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'invoice_id',
        'product_id',
        'quantity',
        'price',
    ];
}
