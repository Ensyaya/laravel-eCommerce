<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $userId = auth()->user()->id;
        $orders = Order::where('user_id', $userId)->with('orderItems.products')->latest()->paginate(3);
        return view('order/order', compact('orders'));
    }

    public function create(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $userName = auth()->user()->name;

        $order =  Order::create([
            'user_id' => $userId,
            'user_name' => $userName,
            'user_phone_number' => $request->post('user_phone_number'),
            'user_address' => $request->post('user_address'),
        ]);

        $cart = Cart::with('cartItems')->where('id', $id)->first();

        foreach ($cart->cartItems as $cartItem) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_price' => $cartItem->products->price,
                'product_discounted_price' => $cartItem->products->discounted_price,
                'quantity' => $cartItem->quantity,
            ]);

            $cartItem->products->update([
                'quantity' => $cartItem->products->quantity -= $cartItem->quantity
            ]);
        }

        $cart->delete();

        return redirect()->route('order.index')->withSuccess('Order successfully created');
    }
}
