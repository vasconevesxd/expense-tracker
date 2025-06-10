<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['category_id', 'type_id', 'amount', 'date', 'description'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class, 'type_id');
    }
}
