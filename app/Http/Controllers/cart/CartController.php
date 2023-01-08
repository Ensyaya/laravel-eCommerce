<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $userId = auth()->user()->id;
        $cart = Cart::with('cartItems.products')->firstOrCreate(['user_id' => $userId]);
        return view('cart/cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $userId = auth()->user()->id;
        $productId = $id;
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $productId,
        ]);
        $cartItem->quantity += 1;
        $cartItem->save();

        if (!$cartItem) {
            return response()->json('The product has been successfully added to your cart');
        } else {
            return response()->json([
                "message" => 'The product has been successfully added to your cart',
                "cartItemQuantity" => $cartItem->quantity,
                "total" => $cart->total['total'],
                "totalItem" => $cart->total['totalItem'],
            ]);
        }
    }

    public function removeFromCart($id)
    {
        CartItem::findOrFail($id)->delete();
        $userId = auth()->user()->id;
        $cart = Cart::where("user_id", $userId)->first();


        return response()->json([
            "message" => 'The product has been successfully deleted to your cart',
            "total" => $cart->total['total'],
            "totalDiscount" => $cart->total['discount'],
            "baseTotal" => $cart->total['baseTotal'],
            "totalItem" => $cart->total['totalItem'],
        ]);
    }
    public function removeCartItemOne($id)
    {
      $userId = auth()->user()->id;
      $cart = Cart::where("user_id", $userId)->first();
      $cartItem =  CartItem::where("product_id", $id)->first();
    
      if ($cartItem->quantity <= 1) {
        $cartItem->delete();
        return response()->json([
          "removedProductId" => $id,
          "total" => $cart->total['total'],
          "cartItemQuantity" => $cartItem->quantity,
          "totalDiscount" => $cart->total['discount'],
          "baseTotal" => $cart->total['baseTotal'],
          "totalItem" => $cart->total['totalItem'],
        ]);
      }
    
      $cartItem->update(['quantity' => $cartItem->quantity - 1]);
      return response()->json([
        "total" => $cart->total['total'],
        "cartItemQuantity" => $cartItem->quantity,
        "totalDiscount" => $cart->total['discount'],
        "baseTotal" => $cart->total['baseTotal'],
        "totalItem" => $cart->total['totalItem'],
      ]);
    }
}
