<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->products()->with('category');

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        // Quantity filter (supports single or multiple conditions)
        if ($request->filled('quantity')) {
            $quantity = $request->quantity;
            if (is_array($quantity)) {
                foreach ($quantity as $operator => $value) {
                    $query->where('quantity', $this->normalizeOperator($operator), $value);
                }
            } else {
                $query->where('quantity', $request->quantity_operator ?? '=', $quantity);
            }
        }

        // Price range filter
        if ($request->filled('price_min') || $request->filled('price_max')) {
            $query->when($request->price_min, fn($q) => $q->where('price', '>=', $request->price_min))
                ->when($request->price_max, fn($q) => $q->where('price', '<=', $request->price_max));
        }

        return response()->json($query->get());
    }

    private function normalizeOperator(string $operator): string
    {
        return match ($operator) {
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            default => '='
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id,user_id,' . auth()->id(),
        ]);

        $product = auth()->user()->products()->create($validated);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(Product $product)
    {
        $this->authorizeOwner($product);
        return response()->json($product->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product)
    {
        $this->authorizeOwner($product);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'sometimes|integer|min:0',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|exists:categories,id,user_id,' . auth()->id(),
        ]);

        $product->update($validated);

        return response()->json($product->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product)
    {
        $this->authorizeOwner($product);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }

    public function statistics()
    {
        $products = auth()->user()->products();

        $stats = [
            'total_products' => $products->count(),
            'total_quantity' => $products->sum('quantity'),
            'average_price' => round($products->avg('price'), 2),
            'inventory_value' => $products->sum(DB::raw('price * quantity'))
        ];

        return response()->json($stats);
    }

     private function authorizeOwner(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}
