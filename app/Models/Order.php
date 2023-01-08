<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'user_name',
        'user_phone_number',
        'user_address',
        'status'
    ];
    protected $appends = ["total"];

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->orderItems as $item) {
            $total += $item->quantity * ($item->product_discounted_price ?? $item->product_price);
        }
        return $total;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
