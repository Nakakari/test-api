<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'status',
        'reference_number',
        'quantity',
        'price',
        'total_price',
        'user_id',
        'product_id',
    ];
    public $timestamps = false;
}
