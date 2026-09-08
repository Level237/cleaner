<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductReview::with('product')->latest();

        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $reviews = $query->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleApproval(ProductReview $review)
    {
        $review->update([
            'is_approved' => !$review->is_approved
        ]);

        $status = $review->is_approved ? 'approuvé' : 'masqué';
        return back()->with('success', "L'avis a été {$status} avec succès.");
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();

        return back()->with('success', "L'avis a été supprimé avec succès.");
    }
}
