@extends('layouts.admin')

@section('title', __('Categories Management'))

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Category Creation Form -->
    <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-900/80 border border-slate-800 space-y-4 shadow-xl">
        <h3 class="text-sm font-bold text-white border-b border-slate-800 pb-3">{{ __('Add New Category') }}</h3>
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            
            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">Name (English)</label>
                <input type="text" name="name_en" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
            </div>

            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">Name (Arabic)</label>
                <input type="text" name="name_ar" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
            </div>

            <div>
                <label class="block font-bold text-slate-300 uppercase mb-1">Cover Image URL</label>
                <input type="text" name="image" value="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" checked class="rounded bg-slate-950 border-slate-700 text-amber-500">
                <label class="font-bold text-slate-300">{{ __('Featured') }}</label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-amber-500 text-slate-950 font-black uppercase tracking-wider">
                {{ __('Create Category') }}
            </button>
        </form>
    </div>

    <!-- Category List Table -->
    <div class="lg:col-span-8 rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden shadow-xl">
        <table class="w-full text-left rtl:text-right text-xs">
            <thead class="bg-slate-950 text-slate-400 uppercase text-[10px] tracking-wider border-b border-slate-800">
                <tr>
                    <th class="py-3 px-4">{{ __('Item') }}</th>
                    <th class="py-3 px-4">{{ __('Arabic Name') }}</th>
                    <th class="py-3 px-4">{{ __('Products Count') }}</th>
                    <th class="py-3 px-4">{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 font-medium">
                @foreach($categories as $category)
                    <tr>
                        <td class="py-3 px-4 flex items-center gap-3">
                            <img src="{{ $category->image }}" class="w-10 h-10 rounded-lg object-cover border border-slate-800">
                            <span class="font-bold text-white">{{ $category->name }}</span>
                        </td>
                        <td class="py-3 px-4 text-slate-300 font-bold">{{ $category->name_ar }}</td>
                        <td class="py-3 px-4 text-amber-400 font-bold">{{ $category->products_count }} {{ __('Items') }}</td>
                        <td class="py-3 px-4">
                            @if($category->is_featured)
                                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-amber-500/20 text-amber-400">{{ __('Featured') }}</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-slate-800 text-slate-400">{{ __('Standard') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
