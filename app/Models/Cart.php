<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
    ];
    protected $appends = ["total"];

    public function getTotalAttribute()
    {
        $total = 0;
        $discount = 0;
        $baseTotal = 0;
        $totalItem = 0;


        foreach ($this->cartItems as $item) {
            $totalItem += $item->quantity;
            $baseTotal += $item->quantity * $item->products->price;
            $total += $item->quantity * ($item->products->discounted_price ?? $item->products->price);
            $discount += $item->quantity * ($item->products->price - ($item->products->discounted_price ?? $item->products->price));
        }

        return [
            'total' =>  number_format($total, 2, '.', ' '),
            'discount' =>  number_format($discount, 2, '.', ' '),
            'baseTotal' =>  number_format($baseTotal, 2, '.', ' '),
            'totalItem' => $totalItem,
        ];
    }


    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
