<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('total_quantity', 'total_price');
    }

    // public function price():Attribute
    // {

    //     return Attribute::make(
    //         get:fn($value) => str_replace('.',',',$value/10) . ' FCFA'
    //     );
    // }

    public function getFormattedPriceAttribute()
    {

        return str_replace('.', ',', $this->price / 10) . ' FCFA';
    }
}