<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['name'];

    public function incomes()
    {
        return $this->hasMany(Income::class, 'person_id');
    }
}
