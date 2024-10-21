<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function getCartCount()
    {
        return Cart::where('user_id', Auth::user()->id)->count();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        $product = Product::find($request->product_id);

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
                'price' => $product->price * ($cart->quantity + $request->quantity),
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price * $request->quantity,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->update([
            'cart_count' => Cart::where('user_id', Auth::user()->id)->count(),
        ]);

        return back()->with('success', 'Product Successfully added to cart.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
        ]);

        Cart::find($request->id)
            ->delete();

        $user = User::find(Auth::user()->id);
        $user->update([
            'cart_count' => Cart::where('user_id', Auth::user()->id)->count(),
        ]);

        return back()->with('success', 'Product Successfully removed from cart.');
    }
}
