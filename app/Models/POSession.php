<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSession extends Model
{
    use HasFactory;
    protected $table = 'session';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'warehouse_id',
        'user_id',
        'session_code',
        'status',
        'opened_at',
        'closed_at',
        'cash_in_hand',
        'session_total',
    ];
    public function biller()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }
}
