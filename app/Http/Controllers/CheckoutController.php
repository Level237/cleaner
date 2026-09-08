<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

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

        $shipping_cost = 5.00; // Frais de port fixes pour l'exemple
        $total = $subtotal + $shipping_cost;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping_cost', 'total'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'shipping_method' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $subtotal = 0;
            $itemsData = [];

            foreach ($cart as $key => $item) {
                $product = Product::find($item['product_id']);
                if (!$product) continue;
                
                $variant = null;
                if (isset($item['variant_id'])) {
                    $variant = ProductVariant::find($item['variant_id']);
                }
                
                $price = $product->price + ($variant ? $variant->price : 0);
                $totalPrice = $price * $item['quantity'];
                $subtotal += $totalPrice;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'product_variant_id' => $variant ? $variant->id : null,
                    'product_name' => $product->name,
                    'variant_name' => $variant ? $variant->name : null,
                    'sku' => $variant ? $variant->sku : $product->sku,
                    'quantity' => $item['quantity'],
                    'unit_price' => $price,
                    'total_price' => $totalPrice,
                ];
            }

            $shipping_cost = 5.00; // Fixe pour l'instant
            $total = $subtotal + $shipping_cost;

            $order = Order::create([
                'user_id' => auth()->id(), // null si invité
                'reference' => 'CLN-' . strtoupper(Str::random(8)),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'country' => $validated['country'],
                'postal_code' => $validated['postal_code'],
                'notes' => $validated['notes'],
                'shipping_method' => $validated['shipping_method'],
                'currency' => session('currency', config('currency.default')),
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping_cost,
                'discount' => 0,
                'total' => $total,
                'ip_address' => $request->ip(),
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            DB::commit();

            // Vider le panier
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->reference);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la création de votre commande.')->withInput();
        }
    }

    public function success($reference)
    {
        $order = Order::where('reference', $reference)->firstOrFail();
        
        // Empêcher l'accès si la commande n'appartient pas à l'utilisateur connecté 
        // ou si la session ne correspond pas. Pour un invité, on se base juste sur la ref pour l'instant.
        // En vrai production, on pourrait ajouter un token de session.
        
        return view('checkout.success', compact('order'));
    }
}
