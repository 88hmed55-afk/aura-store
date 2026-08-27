<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search query
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                  ->orWhere('name_ar', 'like', "%{$search}%")
                  ->orWhere('description_en', 'like', "%{$search}%")
                  ->orWhere('description_ar', 'like', "%{$search}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // In Stock Filter
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        switch ($request->get('sort', 'newest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
                $query->orderBy('sales_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();
        $maxPriceVal = Product::max('price') ?? 5000;

        return view('products.index', compact('products', 'categories', 'maxPriceVal'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'reviews.user'])->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Recently Viewed items stored in session
        $recentlyViewed = session()->get('recently_viewed', []);
        if (!in_array($product->id, $recentlyViewed)) {
            array_unshift($recentlyViewed, $product->id);
            $recentlyViewed = array_slice($recentlyViewed, 0, 5);
            session()->put('recently_viewed', $recentlyViewed);
        }

        $recentProducts = Product::whereIn('id', array_diff($recentlyViewed, [$product->id]))->take(4)->get();

        return view('products.show', compact('product', 'relatedProducts', 'recentProducts'));
    }

    public function toggleWishlist(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'auth_required', 'message' => __('Please log in to add to wishlist.')], 401);
        }

        $userId = Auth::id();
        $existing = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();

        if ($existing) {
            $existing->delete();
            $added = false;
            $message = __('Removed from wishlist.');
        } else {
            Wishlist::create(['user_id' => $userId, 'product_id' => $id]);
            $added = true;
            $message = __('Added to wishlist!');
        }

        $count = Wishlist::where('user_id', $userId)->count();

        return response()->json([
            'status' => 'success',
            'added' => $added,
            'count' => $count,
            'message' => $message
        ]);
    }

    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('Please log in to view your wishlist.'));
        }

        $wishlistItems = Wishlist::with('product.category')->where('user_id', Auth::id())->get();
        return view('products.wishlist', compact('wishlistItems'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        if (!Auth::check()) {
            return back()->with('error', __('Please log in to leave a review.'));
        }

        Review::create([
            'product_id' => $id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        // Recalculate rating
        $product = Product::findOrFail($id);
        $avgRating = Review::where('product_id', $id)->where('is_approved', true)->avg('rating');
        $product->update(['rating' => round($avgRating, 2)]);

        return back()->with('success', __('Thank you! Your review has been submitted.'));
    }
}
