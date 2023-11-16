<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosInvoiceProducts extends Model
{
    use HasFactory;
    protected $table = 'pos_invoice_products';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'invoice_id',
        'product_id',
        'quantity',
        'price',
    ];
}
