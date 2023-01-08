<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_name',
        'product_id',
        'content'
    ];
    public function replies()
    {
        return $this->hasMany(ProductReply::class, 'product_questions_id');
    }
}
