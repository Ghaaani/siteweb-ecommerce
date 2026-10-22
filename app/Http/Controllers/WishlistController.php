<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\product;
use App\Models\product_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * The product ids saved in the visitor's wish list.
     */
    protected function items(): array
    {
        return array_values(array_unique((array) session('wishlist', [])));
    }

    /**
     * Show the wish list page.
     */
    public function index()
    {
        $ids = $this->items();

        $products = product::whereIn('id', $ids)->get();

        $categories = product_category::All();
        $carts = cart_item::latest()->take(2)->get();
        $number = cart_item::All();

        return view('wishlist', compact('products', 'categories', 'carts', 'number'));
    }

    /**
     * Add a product to the wish list, or remove it when it is already there.
     */
    public function toggle(Request $request, $productId)
    {
        if (!product::find($productId)) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $ids = $this->items();
        $added = !in_array($productId, $ids);

        if ($added) {
            $ids[] = $productId;
        } else {
            $ids = array_values(array_diff($ids, [$productId]));
        }

        session(['wishlist' => $ids]);

        return response()->json([
            'success' => true,
            'added' => $added,
            'count' => count($ids),
            'message' => $added ? 'Added to your wish list' : 'Removed from your wish list',
        ]);
    }
}
