@extends('layouts.admin')

@section('title', __('Products Management'))

@section('content')

<div class="space-y-6" x-data="{ showModal: false }">
    
    <!-- Action Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-bold text-white">{{ __('Catalog List') }} ({{ $products->total() }})</h2>
        <button @click="showModal = true" class="px-5 py-2.5 rounded-xl bg-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider hover:bg-amber-400 flex items-center gap-2 shadow-lg">
            <i class="fa-solid fa-plus"></i>
            <span>{{ __('Add New Product') }}</span>
        </button>
    </div>

    <!-- Products Table -->
    <div class="rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-xl">
        <table class="w-full text-left rtl:text-right text-xs">
            <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                <tr>
                    <th class="py-3 px-4">{{ __('Item') }}</th>
                    <th class="py-3 px-4">{{ __('Category') }}</th>
                    <th class="py-3 px-4">{{ __('Price') }}</th>
                    <th class="py-3 px-4">{{ __('Stock') }}</th>
                    <th class="py-3 px-4">{{ __('SKU') }}</th>
                    <th class="py-3 px-4 text-center">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 font-medium">
                @foreach($products as $product)
                    <tr class="hover:bg-slate-800/40">
                        <td class="py-3 px-4 flex items-center gap-3">
                            <img src="{{ $product->image }}" class="w-10 h-10 rounded-lg object-cover border border-slate-800">
                            <div>
                                <span class="block font-bold text-white">{{ $product->name }}</span>
                                <span class="text-[10px] text-amber-400">{{ __('Rating') }}: {{ number_format($product->rating, 2) }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-slate-300">{{ $product->category->name ?? '' }}</td>
                        <td class="py-3 px-4 font-bold text-white">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold {{ $product->stock > 5 ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                                {{ $product->stock }} {{ __('in stock') }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-mono text-slate-400">{{ $product->sku }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white font-bold text-[11px] flex items-center gap-1 transition-all">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4 border-t border-slate-800">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Create Product Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="showModal = false"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative w-full max-w-2xl p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-2xl space-y-6">
                <div class="flex justify-between items-center border-b border-slate-800 pb-4">
                    <h3 class="text-base font-bold text-white">{{ __('Create New Product') }}</h3>
                    <button @click="showModal = false" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">Name (EN)</label>
                            <input type="text" name="name_en" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">Name (AR)</label>
                            <input type="text" name="name_ar" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Category') }}</label>
                            <select name="category_id" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('SKU') }}</label>
                            <input type="text" name="sku" required value="AURA-{{ rand(1000, 9999) }}" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white font-mono">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Price') }} ($)</label>
                            <input type="number" step="0.01" name="price" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">Compare Price ($)</label>
                            <input type="number" step="0.01" name="compare_price" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 uppercase mb-1">{{ __('Stock') }}</label>
                            <input type="number" name="stock" value="10" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-300 uppercase mb-1">Main Image URL</label>
                        <input type="text" name="image" required value="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-300 uppercase mb-1">Description (EN)</label>
                        <textarea name="description_en" rows="2" required class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white"></textarea>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-300 uppercase mb-1">Description (AR)</label>
                        <textarea name="description_ar" rows="2" required class="w-full bg-slate-950 border border-slate-700 rounded-xl p-3 text-white"></textarea>
                    </div>

                    <div class="flex items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" checked class="rounded bg-slate-950 border-slate-700 text-amber-500">
                            <span class="font-bold text-slate-300">{{ __('Featured') }}</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_new" value="1" checked class="rounded bg-slate-950 border-slate-700 text-amber-500">
                            <span class="font-bold text-slate-300">{{ __('NEW') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-amber-500 text-slate-950 font-black uppercase tracking-wider">
                        {{ __('Save Product') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
