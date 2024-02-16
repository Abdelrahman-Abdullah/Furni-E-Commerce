<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'transaction_status',
        'total_amount',
    ];
    protected $casts = [
        'transaction_status' => PaymentStatusEnum::class,
    ];
}
