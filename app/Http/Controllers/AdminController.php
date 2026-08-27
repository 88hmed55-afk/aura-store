<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('final_amount');
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->get();
        $recentOrders = Order::with('user')->latest()->take(6)->get();

        $orderStatusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'lowStockProducts',
            'recentOrders',
            'orderStatusCounts'
        ));
    }

    // Products Management
    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
            'image' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name_en']) . '-' . rand(100, 999);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');

        Product::create($validated);

        return back()->with('success', __('Product created successfully!'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'image' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');

        $product->update($validated);

        return back()->with('success', __('Product updated successfully!'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', __('Product deleted.'));
    }

    // Categories Management
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name_en']);
        $validated['is_featured'] = $request->has('is_featured');

        Category::create($validated);

        return back()->with('success', __('Category created successfully!'));
    }

    // Orders Management
    public function orders()
    {
        $orders = Order::with('user', 'items.product')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);

        $order->update(['status' => $request->status]);

        return back()->with('success', __('Order status updated to ') . __($request->status));
    }

    // Coupons Management
    public function coupons()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function storeCoupon(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'min_order_amount' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        $validated['is_active'] = true;

        Coupon::create($validated);

        return back()->with('success', __('Coupon created successfully!'));
    }

    public function toggleCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
        return back()->with('success', __('Coupon status updated.'));
    }

    // Reviews Management
    public function reviews()
    {
        $reviews = Review::with(['product', 'user'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => !$review->is_approved]);
        return back()->with('success', __('Review approval toggled.'));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return back()->with('success', __('Review deleted.'));
    }
}
