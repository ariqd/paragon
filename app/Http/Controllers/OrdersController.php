<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::where('user_id', auth()->id())->get()
        ]);
    }

    public function checkout()
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => cart()->getTotal(),
            'count' => array_sum(array_column(cart()->items(), 'quantity')),
            'status' => 'Menunggu Konfirmasi'
        ]);

        if ($order) {
            foreach (cart()->items() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['modelId'],
                    'quantity' => $item['quantity']
                ]);
            }
        }

        cart()->clear();

        return redirect()->route('order.index')->with('info', 'Pesanan berhasil dibuat');
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }
}
