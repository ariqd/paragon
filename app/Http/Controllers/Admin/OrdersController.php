<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::latest()->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($order->status == 'Menunggu Konfirmasi') {
            if ($request->decision == 'confirm') {
                $order->status = 'Telah Dikonfirmasi';
                $order->save();

                foreach ($order->items as $item) {
                    $currentStock = $item->product->stock;
                    $item->product->stock = $currentStock - $item->quantity;
                    $item->product->save();
                }

                Activity::create([
                    'message' => 'Admin "' . auth()->user()->name . '" mengonfirmasi pesanan dengan ID # ' . $order->id
                ]);

                return redirect()->back()->with('info', 'Pesanan berhasil dikonfirmasi.');
            } else {
                // Batalkan / decline pesanan
                $order->status = 'Dibatalkan oleh Admin';
                $order->cancel_reason = $request->cancel_reason;
                $order->save();

                Activity::create([
                    'message' => 'Admin "' . auth()->user()->name . '" membatalkan pesanan dengan ID # ' . $order->id
                ]);

                return redirect()->back()->with('info', 'Pesanan telah dibatalkan oleh Admin.');
            }
        }
    }
}
