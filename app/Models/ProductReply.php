<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReply extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_questions_id',
        'content',
        'user_name',
        'user_id',

    ];

    public function productQuestions()
    {
        return $this->belongsTo(ProductQuestion::class);
    }
}
