<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $inCart = [];
        $count = 0;

        foreach (cart()->items() as $id => $item) {
            $product = Product::find($item['modelId']);

            // if ($product->stock <= cart()->items()[$id]['quantity']) {
            $inCart[$count]['id'] = $product->id;
            $inCart[$count]['name'] = $product->name;
            $inCart[$count]['stock_left'] = $product->stock;
            $inCart[$count]['type'] = $product->type;

            $count++;
            // }
        }

        return view('cart.index', [
            'cart' => cart()->toArray(),
            'removed' => $inCart,
            'count' => $count
        ]);
    }

    public function addToCart(Product $product)
    {
        $key = array_search($product->id, array_column(cart()->items(), 'modelId'));

        if (isset($key) && is_numeric($key)) {
            if ($this->checkIfStockExist($key, $product)) {
                Product::addToCart($product->id);

                return redirect()->back()->with('info', 'Obat berhasil ditambahkan ke keranjang');
            }

            return redirect()->back()->with('error', 'Stok obat sudah habis.');
        } else {
            Product::addToCart($product->id, 10);

            return redirect()->back()->with('info', 'Obat berhasil ditambahkan ke keranjang');
        }
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
        if (!$this->checkIfStockExist($id, $product)) return redirect()->back()->with('error', 'Stok obat sudah maksimum.');

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

    public function update(Request $request, $id, Product $product)
    {
        $request->validate([
            'newQty' => 'required|integer|min:10',
        ]);

        if ($request->newQty > $product->stock) {
            return redirect()->back()->with('error', 'Qty baru melebihi stok tersedia.');
        }

        if (!$this->checkIfStockExist($id, $product, $request->newQty, TRUE)) return redirect()->back()->with('error', 'Stok obat sudah maksimum.');

        cart()->removeAt($id);

        Product::addToCart($product->id, $request->newQty);

        return redirect()->back()->with('info', 'Jumlah Obat berhasil diubah');
    }

    public function checkIfStockExist($cartId, $product, $addition = 1, $update = FALSE)
    {
        if ($product->stock < 10) {
            cart()->removeAt($cartId);

            return FALSE;
        }

        $newQty = $update ? $addition : (cart()->items()[$cartId]['quantity'] + $addition);

        // isset(cart()->items()[$cartId])

        // if ($update) {
        //     $newQty = $addition;
        // }

        if ($product->stock < $newQty) {
            return FALSE;
        }

        return TRUE;
    }
}
