<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $removedItems = [];
        $count = 0;

        foreach (cart()->items() as $id => $item) {
            $product = Product::find($item['modelId']);

            if ($product->stock < cart()->items()[$id]['quantity']) {
                $removedItems[$count]['id'] = $product->id;
                $removedItems[$count]['name'] = $product->name;
                $removedItems[$count]['stock_left'] = $product->stock;

                $count++;
            }
        }

        return view('cart.index', [
            'cart' => cart()->toArray(),
            'removed' => $removedItems,
            'count' => $count
        ]);
    }

    public function addToCart(Product $product)
    {
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Stok obat sudah habis.');
        }

        Product::addToCart($product->id);

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
    public function incrementCartItem($id, Product $product)
    {
        if ($product->stock <= cart()->items()[$id]['quantity']) {
            return redirect()->back()->with('error', 'Jumlah pesanan melebihi stok obat saat ini!');
        }

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
