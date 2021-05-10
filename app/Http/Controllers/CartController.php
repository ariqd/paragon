<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Freshbitsweb\LaravelCartManager\Models\Cart;

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
}
