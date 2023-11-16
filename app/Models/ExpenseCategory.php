<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $table = 'expense_category';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'created_by',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
}
