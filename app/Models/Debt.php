<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    protected $fillable = [
        'debtor_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function debtor()
    {
        return $this->belongsTo(Debtor::class, 'debtor_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
