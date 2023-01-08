<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products()
    {
        $products = Product::latest();
        if (request()->get('title')) {
            $products = $products->where('title', 'LIKE', "%" . request()->get('title') . "%");
        }

        $products = $products->paginate(12);

        return view('main-products', compact('products'));
    }
    public function product_detail($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $userId = auth()->user()->id;
        $productId = $product->id;
        $questionsAll = ProductQuestion::where('product_id', $productId)->latest()->get();
        $questions = ProductQuestion::with('replies')->where('product_id', $productId)->latest()->paginate(3, ['*'], 'questions');
        $ratingAll = ProductRating::where('product_id', $productId)->count();
        $ratePerRaters = number_format(ProductRating::where('product_id', $productId)->avg('rate'), 1, '.', ' ');

        $ratings = ProductRating::where('product_id', $productId)->latest()->paginate(3, ['*'], 'reatings');
        $orders = Order::where('user_id', $userId)->where('status', 'Delivered')->with('orderItems')->get();

        $isOrdered = false;
        $isProductRating = ProductRating::where('user_id', $userId)->where('product_id', $productId)->count();
        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                if ($orderItem->product_id == $productId) {
                    $isOrdered = true;
                }
            }
        }

        return view('main-product-detail', compact(
            'product',
            'questions',
            'questionsAll',
            'ratingAll',
            'ratings',
            'isOrdered',
            'ratePerRaters',
            'isProductRating'
        ));
    }
}
