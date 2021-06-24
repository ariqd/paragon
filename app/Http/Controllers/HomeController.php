<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (@$request->get('category')) {
            $data['products'] = Product::byCategory(@$request->get('category'))->get();
        } else if (@$request->get('nama')) {
            $data['products'] = Product::byName(@$request->get('nama'))->get();
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
