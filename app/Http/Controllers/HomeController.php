<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show()
    {
        return view('products.show');
    }
}
