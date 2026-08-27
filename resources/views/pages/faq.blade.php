@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12" x-data="faqStore()">
    
    <!-- FAQ Header & Search -->
    <div class="text-center space-y-4">
        <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">{{ __('Knowledge Base') }}</span>
        <h1 class="text-4xl font-black text-white">{{ __('Frequently Asked Questions') }}</h1>
        <p class="text-xs sm:text-sm text-slate-300 font-medium">{{ __('Everything you need to know about purchasing, shipping, and warranty.') }}</p>

        <!-- Live Instant Search Bar -->
        <div class="max-w-xl mx-auto pt-4">
            <div class="relative">
                <input type="text" x-model="searchQuery" placeholder="{{ __('Type to filter questions (e.g. warranty, shipping, coupon)...') }}" class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-xs text-white placeholder-slate-500 outline-none focus:border-amber-500 shadow-xl">
                <i class="fa-solid fa-magnifying-glass absolute {{ app()->getLocale() == 'ar' ? 'left-4' : 'right-4' }} top-4 text-slate-400"></i>
            </div>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="flex flex-wrap justify-center gap-2 border-b border-slate-800 pb-4">
        <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-amber-500 text-slate-950 font-black' : 'bg-slate-900 text-slate-400 hover:text-white'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
            {{ __('All Questions') }}
        </button>
        <button @click="activeCategory = 'horology'" :class="activeCategory === 'horology' ? 'bg-amber-500 text-slate-950 font-black' : 'bg-slate-900 text-slate-400 hover:text-white'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
            {{ __('Horology & Craft') }}
        </button>
        <button @click="activeCategory = 'shipping'" :class="activeCategory === 'shipping' ? 'bg-amber-500 text-slate-950 font-black' : 'bg-slate-900 text-slate-400 hover:text-white'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
            {{ __('Shipping & VIP Concierge') }}
        </button>
        <button @click="activeCategory = 'warranty'" :class="activeCategory === 'warranty' ? 'bg-amber-500 text-slate-950 font-black' : 'bg-slate-900 text-slate-400 hover:text-white'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
            {{ __('Warranty & Security') }}
        </button>
    </div>

    <!-- Questions Accordion -->
    <div class="space-y-4">
        
        <template x-for="(faq, index) in filteredFaqs()" :key="index">
            <div class="p-6 rounded-3xl glass-panel border border-slate-800 space-y-2 transition-all">
                <button @click="openItem = openItem === index ? null : index" class="w-full flex justify-between items-center text-left rtl:text-right font-bold text-white text-sm">
                    <span x-text="faq.question"></span>
                    <i class="fa-solid fa-chevron-down text-xs text-amber-400 transition-transform duration-300" :class="openItem === index ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="openItem === index" x-cloak class="text-xs text-slate-300 pt-4 leading-relaxed border-t border-slate-800/80 space-y-4">
                    <p x-text="faq.answer"></p>
                    
                    <div class="flex items-center justify-between pt-2 border-t border-slate-800/40 text-[11px] text-slate-400">
                        <span>Was this answer helpful?</span>
                        <div class="flex items-center gap-3">
                            <button @click="faq.liked = true" :class="faq.liked ? 'text-amber-400' : 'hover:text-white'" class="flex items-center gap-1">
                                <i class="fa-solid fa-thumbs-up"></i> Yes
                            </button>
                            <button @click="faq.liked = false" class="hover:text-white flex items-center gap-1">
                                <i class="fa-solid fa-thumbs-down"></i> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div x-show="filteredFaqs().length === 0" class="py-12 text-center text-slate-500 font-semibold text-xs glass-panel rounded-3xl border border-slate-800">
            {{ __('No matching questions found for your query.') }}
        </div>

    </div>

</div>

<script>
    function faqStore() {
        return {
            searchQuery: '',
            activeCategory: 'all',
            openItem: 0,
            faqs: [
                {
                    category: 'warranty',
                    question: 'What warranty coverage is included with my purchase?',
                    answer: 'All AURA products come standard with a 5-Year Global Concierge Warranty covering craftsmanship, movement precision, Grade 5 Titanium integrity, and semiconductor hardware defects.',
                    liked: null
                },
                {
                    category: 'shipping',
                    question: 'How fast is global express shipping?',
                    answer: 'Orders are dispatched within 24 hours via VIP express air freight. Typical delivery timeline is 2-4 business days worldwide with real-time GPS tracking and insured courier delivery.',
                    liked: null
                },
                {
                    category: 'horology',
                    question: 'How are AURA products certified for authenticity?',
                    answer: 'Every piece includes an encrypted NFC authenticity certificate linked to an unalterable digital ledger record, detailing individual serial numbers and watchmaker signatures.',
                    liked: null
                },
                {
                    category: 'warranty',
                    question: 'How do promotional coupon codes work?',
                    answer: 'You can enter your promotional code (such as AURA20) in the shopping bag drawer or detailed cart page. The discount will instantly adjust your total balance.',
                    liked: null
                },
                {
                    category: 'horology',
                    question: 'Are AURA timepieces water resistant?',
                    answer: 'Yes, our Horology collection features ocean resistance up to 300 meters (30 ATM) with dual O-ring screw-down crowns and helium escape valves.',
                    liked: null
                },
                {
                    category: 'shipping',
                    question: 'Can I schedule a private VIP showroom appointment?',
                    answer: 'Absolutely. You can request a private appointment at our showrooms in Riyadh, Dubai, London, or Paris through our Concierge contact page.',
                    liked: null
                }
            ],
            filteredFaqs() {
                return this.faqs.filter(faq => {
                    const matchesCategory = this.activeCategory === 'all' || faq.category === this.activeCategory;
                    const matchesSearch = this.searchQuery === '' || 
                        faq.question.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                        faq.answer.toLowerCase().includes(this.searchQuery.toLowerCase());
                    return matchesCategory && matchesSearch;
                });
            }
        }
    }
</script>

@endsection
