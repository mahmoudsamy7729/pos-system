<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'category_id',
        'amount',
        'expense_for',
        'description',
        'reference',
        'created_by',
        'date',
    ];
    public function category()
    {
        return $this->hasOne(ExpenseCategory::class,'id','category_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
}
