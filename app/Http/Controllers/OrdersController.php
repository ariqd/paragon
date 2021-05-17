<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::where('user_id', auth()->id())->latest()->get()
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
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                    'quantity' => $item['quantity']
                ]);
            }

            Activity::create([
                'message' => 'User "' . auth()->user()->name . '" melakukan checkout pesanan dengan ID # ' . $order->id
            ]);

            cart()->clear();

            return redirect()->route('order.index')->with('info', 'Pesanan berhasil dibuat');
        }

        return redirect()->back()->with('error', 'Pesanan gagal checkout');
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }
}
