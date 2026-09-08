<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $key => $item) {
            $product = Product::with('primaryMedia')->find($item['product_id']);
            if (!$product) continue;
            
            $variant = null;
            if (isset($item['variant_id'])) {
                $variant = ProductVariant::find($item['variant_id']);
            }
            
            $price = $product->price + ($variant ? $variant->price : 0);
            $totalPrice = $price * $item['quantity'];
            
            $subtotal += $totalPrice;
            
            $cartItems[] = [
                'key' => $key,
                'product' => $product,
                'variant' => $variant,
                'quantity' => $item['quantity'],
                'price' => $price,
                'total_price' => $totalPrice
            ];
        }

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $cart = session()->get('cart', []);
        
        $key = $request->product_id . '_' . ($request->variant_id ?? 'default');
        
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produit ajouté au panier',
                'cartCount' => collect($cart)->sum('quantity')
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produit retiré du panier.');
    }
}
