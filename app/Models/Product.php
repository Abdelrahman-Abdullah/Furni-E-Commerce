<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug',
        'price',
        'description',
        'category_id',
        'image',
    ];

    protected $appends = ['imageUrl'];

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset('front-assets/images'.$this->image),
        );
    }
}
