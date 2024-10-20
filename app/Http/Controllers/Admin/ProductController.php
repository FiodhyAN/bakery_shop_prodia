<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(storage_path('app/public/images'), $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
            'image' => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(storage_path('app/public/images'), $imageName);
            $data['image'] = $imageName;

            if ($product->image) {
                unlink(storage_path('app/public/images/' . $product->image));
            }
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->image) {
            unlink(storage_path('app/public/images/' . $product->image));
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
