<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (@$request->get('category')) {
            $product = Product::where('type', @$request->get('category'))->get();
            if ($product)
                $data['products'] = $product;
        } else {
            $data['products'] = Product::all();
        }

        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/', $data['name'] . "." . $extension);
                $data['image'] = Storage::url($data['name'] . "." . $extension);
            }
        } else {
            abort(500, 'Could not upload image :(');
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'image' => ['required'],
            'price' => ['required', 'numeric', 'min:100'],
            'stock' => ['required', 'numeric'],
            'type' => ['required'],
        ])->validate();

        $product = Product::create($data);

        if ($product) {
            Activity::create([
                'message' => 'Admin "' . auth()->user()->name . '" menambahkan produk baru: ' . $product->name
            ]);

            return redirect()->route('admin.products.index')->with('info', 'Produk baru berhasil ditambahkan');
        }

        return redirect()->route('admin.products.index')->with('error', 'Produk gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'edit' => true,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        unset($data['_token']);

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/', $data['name'] . "." . $extension);
                $data['image'] = Storage::url($data['name'] . "." . $extension);
            } else {
                abort(500, 'Could not upload image :(');
            }
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'price' => ['required', 'numeric', 'min:100'],
            'stock' => ['required', 'numeric'],
            'type' => ['required'],
        ])->validate();

        if ($product->update($data)) {
            Activity::create([
                'message' => 'Admin "' . auth()->user()->name . '" mengubah data produk: ' . $product->name
            ]);

            return redirect()->route('admin.products.index')->with('info', 'Data produk berhasil diubah');
        }

        return redirect()->route('admin.products.index')->with('error', 'Data produk gagal diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
