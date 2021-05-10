<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (@$request->get('category')) {
            $product = Product::where('type', @$request->get('category'))->get();
            if ($product)
                $data['products'] = $product;
        } else {
            $data['products'] = Product::all();
        }

        return view('products.index', $data);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }
}
