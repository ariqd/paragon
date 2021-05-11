<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Freshbitsweb\LaravelCartManager\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index', [
            'cart' => cart()->toArray()
        ]);
    }

    public function addToCart($id)
    {
        Product::addToCart($id);

        return redirect()->back()->with('info', 'Obat berhasil ditambahkan ke keranjang');
    }

    public function removeFromCart($id)
    {
        cart()->removeAt($id);

        return redirect()->back()->with('info', 'Obat berhasil dihapus dari keranjang');
    }

    /**
     * Increment cart item quantity
     *
     * @return json
     */
    public function incrementCartItem($id)
    {
        cart()->incrementQuantityAt($id);

        return redirect()->back()->with('info', 'Jumlah Obat berhasil ditambahkan');
    }

    /**
     * Decrement cart item quantity
     *
     * @return json
     */
    public function decrementCartItem($id)
    {
        cart()->decrementQuantityAt($id);

        return redirect()->back()->with('info', 'Jumlah Obat berhasil dikurangi');
    }
}
