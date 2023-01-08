<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'image_id',
        'image2',
        'image_id2',
        'image3',
        'image_id3',
        'category_id',
        'status',
        'discounted_price',
        'discount_rate',
        'discount_finished_at'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'title'
            ]
        ];
    }
}
