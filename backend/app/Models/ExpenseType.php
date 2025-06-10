<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    protected $fillable = ['name'];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'type_id');
    }
}
