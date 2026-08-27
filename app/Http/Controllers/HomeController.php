<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_featured', true)->take(6)->get();
        $featuredProducts = Product::with('category')->where('is_featured', true)->take(8)->get();
        $newArrivals = Product::with('category')->where('is_new', true)->latest()->take(8)->get();
        $bestSellers = Product::with('category')->orderBy('sales_count', 'desc')->take(4)->get();
        
        // Smart AI Recommendations (High rated & top featured)
        $aiRecommendations = Product::with('category')->where('rating', '>=', 4.8)->inRandomOrder()->take(4)->get();

        return view('home', compact('categories', 'featuredProducts', 'newArrivals', 'bestSellers', 'aiRecommendations'));
    }

    public function switchLanguage($lang)
    {
        if (in_array($lang, ['ar', 'en'])) {
            session(['locale' => $lang]);
        }
        return back();
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        return back()->with('success', __('Thank you for contacting AURA. Our team will get back to you shortly!'));
    }

    public function faq()
    {
        return view('pages.faq');
    }
}
