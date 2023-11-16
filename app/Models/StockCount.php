<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCount extends Model
{
    use HasFactory;
    protected $table = 'stock_count';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'date',
        'inital_file',
        'final_file',
        'type',
        'warehouse_id',
    ];
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }
}
