<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $orders = Order::with('orderItems.products')->latest()->paginate(3);
        return view('admin/order/order', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'status' => $request->post('status'),
        ]);

        $order = Order::with('orderItems.products')->where('id', $id)->first();
        foreach ($order->orderItems as $orderItem) {
            if ($order->status == 'Cancelled') {
                $orderItem->products->update([
                    'quantity' => $orderItem->products->quantity += $orderItem->quantity
                ]);
            }
        }

        return redirect()->route('admin-order.index')->withSuccess('Order status successfully updated');
    }
}
