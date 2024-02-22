<?php

namespace App\Models;

use App\Enums\CouponStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    use HasFactory;
    protected $fillable = ['code', 'value', 'validity'];
    protected $casts = [
        'validity' => CouponStatusEnum::class
    ];
}
