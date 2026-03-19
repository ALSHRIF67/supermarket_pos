<?php
namespace App\Http\Controllers;

use Illuminate\Support\Arr;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier', 'inventory']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('barcode', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter by low stock
        if ($request->boolean('low_stock')) {
            $query->whereHas('inventory', function ($q) {
                $q->lowStock();
            });
        }

        $products = $query->paginate(15)->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }


    public function edit(Product $product)
    {
        $product->load('inventory');
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified product in storage.
     */
        public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('product_image')) {
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }
            $path = $request->file('product_image')->store('products', 'public');
            $validated['product_image'] = $path;
        }

        // Separate product and inventory data
        $productData = Arr::except($validated, ['quantity', 'minimum_stock_alert', 'unit_type']);
        $inventoryData = Arr::only($validated, ['quantity', 'minimum_stock_alert', 'unit_type']);

        // Update product
        $product->update($productData);

        // Update or create inventory
        if ($product->inventory) {
            $product->inventory()->update($inventoryData);
        } else {
            $product->inventory()->create($inventoryData);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        // Delete image
        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}

