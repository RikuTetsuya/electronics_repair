<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'service_ins';
    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'total_harga',
        'customer_id',
        'status_payment',
    ];
}
