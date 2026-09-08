<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'items.variant', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,delivered,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $order->update($validated);

        return back()->with('success', 'La commande a été mise à jour.');
    }
}
