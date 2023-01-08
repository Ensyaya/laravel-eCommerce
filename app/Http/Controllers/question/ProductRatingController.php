<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function index($id)
    {
        $ratings = ProductRating::where('product_id', $id)->latest()->paginate(10);
        $ratingAll = ProductRating::where('product_id', $id)->count();
        $productId = $id;

        return view('admin/product/product-rating', compact(
            'ratingAll',
            'ratings',
            'productId',
        ));
    }

    public function create(Request $request, $id)
    {
        $user = auth()->user();
        $isAdmin = $user->type == 'admin';

        $orders = Order::where('user_id', $user->id)
            ->where('status', 'Delivered')
            ->with('orderItems')
            ->get();

        $hasPurchasedProduct = $orders->contains(function ($order) use ($id, $isAdmin) {
            if ($isAdmin) {
                return true;
            }

            return $order->orderItems->contains(function ($orderItem) use ($id) {
                return $orderItem->product_id == $id;
            });
        });

        if (!$hasPurchasedProduct) {
            return response()->json([
                "message" => 'error',
            ]);
        }

        $isProductRating = ProductRating::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        if ($isProductRating && !$isAdmin) {
            return response()->json([
                "message" => 'error',
            ]);
        }

        $productRating = ProductRating::create([
            'user_id' => $user->id,
            'product_id' => $id,
            'user_name' => $user->name,
            'content' => $request->post('content'),
            'rate' => $request->post('rate'),
        ]);

        $ratingCount = ProductRating::where('product_id', $id)->count();
        $formattedDate = $productRating->created_at->format('Y-m-d H:i:s');
        $ratingCount = ProductRating::where('product_id', $id)->count();
        $averageRating = number_format(ProductRating::where('product_id', $id)->avg('rate'), 1, '.', ' ');


        return response()->json([
            "message" => 'Rate successfully created',
            "ratingCount" => $ratingCount,
            'user_name' => $productRating->user_name,
            'content' => $productRating->content,
            'rating_rate' => $productRating->rate,
            'created_at' => $formattedDate,
            'ratePerRaters' => $averageRating
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $productRating = ProductRating::findOrFail($id);
        $productRating->delete();

        $productId = $request->post('productId');
        $ratingCount = ProductRating::where('product_id', $productId)->count();
        $averageRating = number_format(ProductRating::where('product_id', $productId)->avg('rate'), 1, '.', ' ');

        return response()->json([
            "message" => 'Rating successfully deleted',
            "ratingCount" => $ratingCount,
            'ratePerRaters' => $averageRating
        ]);
    }
}
