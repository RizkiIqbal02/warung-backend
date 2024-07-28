<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gender', 'total'];

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
