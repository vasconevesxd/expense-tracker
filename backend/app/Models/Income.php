<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['person_id', 'type_id', 'amount', 'description', 'date'];

    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function incomeType()
    {
        return $this->belongsTo(IncomeType::class, 'type_id');
    }
}
