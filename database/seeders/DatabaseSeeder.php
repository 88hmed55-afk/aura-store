<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin & Customer Users
        $admin = User::create([
            'name' => 'AURA Executive Admin',
            'email' => 'admin@aura.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '+966 50 000 0000',
            'address' => 'Riyadh Financial District, Saudi Arabia',
        ]);

        $customer = User::create([
            'name' => 'Fahad Al-Mansoor',
            'email' => 'customer@aura.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '+966 55 123 4567',
            'address' => 'King Fahd Road, Villa 42, Riyadh',
        ]);

        // 2. Categories
        $categoriesData = [
            [
                'name_en' => 'Smart Horology',
                'name_ar' => 'الساعات الذكية والفاخرة',
                'slug' => 'smart-horology',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name_en' => 'Acoustic Masterpieces',
                'name_ar' => 'الصوتيات الفاخرة',
                'slug' => 'acoustic-masterpieces',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name_en' => 'Vision & Mobility',
                'name_ar' => 'النظارات والأجهزة الشخصية',
                'slug' => 'vision-mobility',
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name_en' => 'Executive Accessories',
                'name_ar' => 'إكسسوارات كبار الشخصيات',
                'slug' => 'executive-accessories',
                'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'name_en' => 'Luxury Wearables',
                'name_ar' => 'الخواتم والأطواق الذكية',
                'slug' => 'luxury-wearables',
                'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=800&auto=format&fit=crop',
                'is_featured' => true,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $catData) {
            $categories[$catData['slug']] = Category::create($catData);
        }

        // 3. Products
        $productsData = [
            // Category 1: Smart Horology
            [
                'category_id' => $categories['smart-horology']->id,
                'name_en' => 'Chronos Titan X Edition Watch',
                'name_ar' => 'ساعة كرونوس تيتان إكس الفاخرة',
                'slug' => 'chronos-titan-x-edition-watch',
                'description_en' => 'Crafted from aerospace-grade Grade 5 Titanium with Sapphire Glass display, featuring advanced health metrics, ECG precision monitoring, and 14-day battery reserve.',
                'description_ar' => 'مصنوعة من التيتانيوم الدرجة 5 المستخدم في صناعات الطيران والفضاء مع زجاج الزفير المقاوم للخدش، تتميز بتقنيات قياس المؤشرات الحيوية والتخطيط الدقيق للقلب مع بطارية تدوم 14 يوماً.',
                'price' => 2499.00,
                'compare_price' => 2899.00,
                'stock' => 15,
                'sku' => 'AURA-HOR-001',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop',
                'additional_images' => ['https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=800&auto=format&fit=crop'],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.95,
                'sales_count' => 42,
            ],
            [
                'category_id' => $categories['smart-horology']->id,
                'name_en' => 'Solaris Nebula Ceramic Sapphire Chronograph',
                'name_ar' => 'ساعة سولاريس نيبولا السيراميكية',
                'slug' => 'solaris-nebula-ceramic-sapphire-chronograph',
                'description_en' => 'Ultra-dense scratchproof ceramic casing, solar-charging dial, ocean resistance up to 300 meters, handcrafted GMT movement.',
                'description_ar' => 'هيكل سيراميكي متين مقاوم للخدش، مينا شحن بالتقاط الطاقة الشمسية، مقاومة للماء والغوص حتى عمق 300 متر مع حركة توقيت عالمي يدوي.',
                'price' => 4150.00,
                'compare_price' => 4500.00,
                'stock' => 6,
                'sku' => 'AURA-HOR-002',
                'image' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 5.00,
                'sales_count' => 11,
            ],
            [
                'category_id' => $categories['smart-horology']->id,
                'name_en' => 'Apex Carbon Racing Edition Watch',
                'name_ar' => 'ساعة آبيكس كربون فورمولا الرياضية',
                'slug' => 'apex-carbon-racing-edition-watch',
                'description_en' => 'Forged carbon fiber casing with skeletonized movement, dual time display, and perforated Italian racing leather strap.',
                'description_ar' => 'هيكل من ألياف الكربون المشكّلة مع محرك مكشوف التفاصيل، تعرض توقيتين مختلفين مع حزام مدمج من الجلد الإيطالي الفاخر.',
                'price' => 3800.00,
                'compare_price' => 4200.00,
                'stock' => 8,
                'sku' => 'AURA-HOR-003',
                'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => false,
                'rating' => 4.88,
                'sales_count' => 29,
            ],
            [
                'category_id' => $categories['smart-horology']->id,
                'name_en' => 'Imperium Rose Gold Heritage Watch',
                'name_ar' => 'ساعة إمبيريوم بالذهب الوردي الملكي',
                'slug' => 'imperium-rose-gold-heritage-watch',
                'description_en' => '18k Solid Rose Gold bezel with automatic tourbillon balance, sapphire crystal case back, and hand-stitched alligator leather strap.',
                'description_ar' => 'إطار من الذهب الوردي الخالص عيار 18 مع محرك التوربيون الأوتوماتيكي الخلاق، خلفية كريسالتية شفافة وسوار مصنوع يدوياً من جلد التمساح.',
                'price' => 8900.00,
                'compare_price' => 9500.00,
                'stock' => 3,
                'sku' => 'AURA-HOR-004',
                'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.98,
                'sales_count' => 7,
            ],

            // Category 2: Acoustic Masterpieces
            [
                'category_id' => $categories['acoustic-masterpieces']->id,
                'name_en' => 'AURA Zenith Noise-Cancelling Headphones',
                'name_ar' => 'سماعات أورا زينيث المحيطية مع مانع الضوضاء',
                'slug' => 'aura-zenith-studio-headphones',
                'description_en' => 'Bespoke planar magnetic drivers, genuine lambskin leather ear cushions, custom acoustic tuning, and lossless Bluetooth 5.4 wireless sound architecture.',
                'description_ar' => 'سماعات مغناطيسية مستوية مصممة خصيصاً مع وسائد من جلد الحمل الطبيعي، ضبط صوتي احترافي وتقنية بلوتوث 5.4 لنقل الصوت بدون أي فقدان في الجودة.',
                'price' => 1850.00,
                'compare_price' => 2100.00,
                'stock' => 8,
                'sku' => 'AURA-AUD-001',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => false,
                'rating' => 4.90,
                'sales_count' => 89,
            ],
            [
                'category_id' => $categories['acoustic-masterpieces']->id,
                'name_en' => 'Vortex Studio Wireless Speaker System',
                'name_ar' => 'نظام الصوت الاسلكي فورتكس ستوديو',
                'slug' => 'vortex-studio-wireless-speaker',
                'description_en' => '360-degree spatial acoustic dispersion, walnut wood casing with rose gold accents, multi-room sync, and AirPlay 3 integration.',
                'description_ar' => 'توزيع صوتي محيطي 360 درجة، هيكل من خشب الجوز الطبيعي ولمسات بالذهب الوردي، مزامنة الغرف المتعددة وتقنية إير بلاي 3.',
                'price' => 2900.00,
                'compare_price' => 3200.00,
                'stock' => 10,
                'sku' => 'AURA-AUD-002',
                'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => false,
                'is_new' => true,
                'rating' => 4.88,
                'sales_count' => 34,
            ],
            [
                'category_id' => $categories['acoustic-masterpieces']->id,
                'name_en' => 'Acoustic Pulse In-Ear Titanium Monitors',
                'name_ar' => 'سماعات أذن ألياف التيتانيوم الاحترافية',
                'slug' => 'acoustic-pulse-in-ear-titanium-monitors',
                'description_en' => 'Dual armature balanced acoustic drivers, silver-plated oxygen-free copper cables, noise isolating titanium shells.',
                'description_ar' => 'سماعات أذن احترافية داخلية بهيكل من التيتانيوم ومحركات صوت مدمة تمنح نقاءً استثنائياً ونقل حركة دقيق مع كابلات فضية خالصة.',
                'price' => 950.00,
                'compare_price' => 1100.00,
                'stock' => 20,
                'sku' => 'AURA-AUD-003',
                'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.82,
                'sales_count' => 50,
            ],
            [
                'category_id' => $categories['acoustic-masterpieces']->id,
                'name_en' => 'Symphony Tube Vacuum Amplifier System',
                'name_ar' => 'مضخم الصوت الصمامي الفاخر سمفوني',
                'slug' => 'symphony-tube-vacuum-amplifier-system',
                'description_en' => 'Handcrafted vacuum tube analog amplifier delivering warm audiophile soundstage with brushed aluminum chassis.',
                'description_ar' => 'مضخم صوت أنبوبي تناظري مصنوع يدوياً يضمن تجربة نغمة دافئة لعشاق الصوتيات النقية مع هيكل ألومنيوم مصقول عالي المتانة.',
                'price' => 5400.00,
                'compare_price' => 6000.00,
                'stock' => 4,
                'sku' => 'AURA-AUD-004',
                'image' => 'https://images.unsplash.com/photo-1558089687-f282ffcbc126?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => false,
                'rating' => 4.96,
                'sales_count' => 15,
            ],

            // Category 3: Vision & Mobility
            [
                'category_id' => $categories['vision-mobility']->id,
                'name_en' => 'Spectra AR Smart Vision Glasses',
                'name_ar' => 'نظارات سبكترا الذكية المعززة بالواقع',
                'slug' => 'spectra-ar-smart-vision-glasses',
                'description_en' => 'Micro-OLED heads-up display integrated into ultra-lightweight carbon fiber frames. Real-time translation, navigation overlay, and voice AI assistant.',
                'description_ar' => 'شاشة عرض صغيرة مدمجة في إطار من ألياف الكربون فائقة الخفة. تمنحك ترجمة فورية في الوقت الفعلي، وتوجيه ملاحي، ومساعد ذكاء اصطناعي صوتي.',
                'price' => 3200.00,
                'compare_price' => 3600.00,
                'stock' => 4,
                'sku' => 'AURA-VIS-001',
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.85,
                'sales_count' => 19,
            ],
            [
                'category_id' => $categories['vision-mobility']->id,
                'name_en' => 'AURA Optics Matte Titanium Eyewear',
                'name_ar' => 'نظارات أورا أوبتكس التيتانيوم المطفأ',
                'slug' => 'aura-optics-matte-titanium-eyewear',
                'description_en' => 'Zero-weight Japanese Grade 5 titanium frame with anti-reflective blue-light filtering Carl Zeiss lenses.',
                'description_ar' => 'إطار ياباني من التيتانيوم فائق الخفة بدون وزن محسوس، مزودة بعدسات زايس الألمانية للوقاية من الضوء الأزرق وحماية العين.',
                'price' => 1250.00,
                'compare_price' => 1400.00,
                'stock' => 18,
                'sku' => 'AURA-VIS-002',
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => false,
                'is_new' => false,
                'rating' => 4.79,
                'sales_count' => 45,
            ],
            [
                'category_id' => $categories['vision-mobility']->id,
                'name_en' => 'CyberShade Electrochromic Sun Visor',
                'name_ar' => 'نظارة سايبششيد الذكية بالتحكم الإلكتروني للتظليل',
                'slug' => 'cybershade-electrochromic-sun-visor',
                'description_en' => 'Touch-controlled instant tint transition from clear to midnight polarization in less than 0.1 seconds.',
                'description_ar' => 'تغير لوني إلكتروني باللمس يتيح الانتقال من التظليل الشفاف إلى الاستقطاب الكامل في أقل من 0.1 ثانية.',
                'price' => 1650.00,
                'compare_price' => 1900.00,
                'stock' => 12,
                'sku' => 'AURA-VIS-003',
                'image' => 'https://images.unsplash.com/photo-1508296695146-257a814070b4?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.91,
                'sales_count' => 31,
            ],

            // Category 4: Executive Accessories
            [
                'category_id' => $categories['executive-accessories']->id,
                'name_en' => 'Monolith MagSafe Biometric Power Bank',
                'name_ar' => 'بنك الطاقة المونوليث ببصمة الأصبع والشحن السريع',
                'slug' => 'monolith-magsafe-biometric-powerbank',
                'description_en' => 'CNC machined aluminum body with 25,000mAh battery reserve, 140W fast GaN charging, biometric encryption, and dynamic OLED status screen.',
                'description_ar' => 'هيكل ألومنيوم مخروط بالكمبيوتر بسعة 25,000 ملي أمبير، شحن سريع بقدرة 140 واط، تشفير ببصمة الأصبع وشاشة أوليد تفاعلية لمعرفة حالة الشحن.',
                'price' => 790.00,
                'compare_price' => 950.00,
                'stock' => 25,
                'sku' => 'AURA-ACC-001',
                'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => false,
                'is_new' => false,
                'rating' => 4.75,
                'sales_count' => 130,
            ],
            [
                'category_id' => $categories['executive-accessories']->id,
                'name_en' => 'Executive Titanium Fountain Pen Set',
                'name_ar' => 'طقم قلم الحبر السائل التنفيذي من التيتانيوم',
                'slug' => 'executive-titanium-fountain-pen-set',
                'description_en' => 'Precision engineered solid titanium body with 18k solid gold nib, magnetic cap closure, and obsidian ink reservoir.',
                'description_ar' => 'قلم حبر تنفيذي من التيتانيوم الخالص مع ريشة من الذهب الخالص عيار 18 وغطاء مغناطيسي آلي وقارورة حبر فاخرة.',
                'price' => 1450.00,
                'compare_price' => 1650.00,
                'stock' => 14,
                'sku' => 'AURA-ACC-002',
                'image' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.97,
                'sales_count' => 62,
            ],
            [
                'category_id' => $categories['executive-accessories']->id,
                'name_en' => 'AURA Vault Biometric Leather Portfolio',
                'name_ar' => 'حقيبة المستندات الجلدية المزودة ببصمة الأصبع',
                'slug' => 'aura-vault-biometric-leather-portfolio',
                'description_en' => 'Full-grain Italian Tuscan leather folio with integrated biometric fingerprint lock and RFID blocking shielding.',
                'description_ar' => 'حقيبة مستندات وتنفيذية مصنوعة من جلد التوسكان الإيطالي الفاخر مع قفل يبصمة الأصبع وحماية لبطاقات الائتمان ضد السرقة الإلكترونية.',
                'price' => 1950.00,
                'compare_price' => 2200.00,
                'stock' => 9,
                'sku' => 'AURA-ACC-003',
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => false,
                'rating' => 4.93,
                'sales_count' => 41,
            ],

            // Category 5: Luxury Wearables
            [
                'category_id' => $categories['luxury-wearables']->id,
                'name_en' => 'AURA Ring Horizon Biometric Tracker',
                'name_ar' => 'خاتم أورا هورايزون الذكي للمؤشرات الحيوية',
                'slug' => 'aura-ring-horizon-biometric-tracker',
                'description_en' => 'Crafted from medical grade titanium with PVD coating. Continuous sleep tracking, HRV analysis, body temperature, and 7-day battery.',
                'description_ar' => 'مصنوع من التيتانيوم الطبي الخالص مع طلاء PVD المقاوم للخدش. تتبع دقيق للنوم، ضربات القلب، حرارة الجسم، وبطارية تدوم 7 أيام.',
                'price' => 1100.00,
                'compare_price' => 1300.00,
                'slug_alt' => 'aura-ring-horizon',
                'stock' => 22,
                'sku' => 'AURA-WEA-001',
                'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.94,
                'sales_count' => 77,
            ],
            [
                'category_id' => $categories['luxury-wearables']->id,
                'name_en' => 'Valkyrie Gold Smart Pendant',
                'name_ar' => 'قلادة فالكيري الذكية من الذهب الخالص',
                'slug' => 'valkyrie-gold-smart-pendant',
                'description_en' => '18k Yellow Gold smart pendant featuring secret haptic emergency SOS alert, voice notes recorder, and activity metrics.',
                'description_ar' => 'قلادة ذكية مصنوعة من الذهب الأصفر عيار 18 تحتوي على نظام تنبيه طوارئ سري ومسجل ملاحظات صوتية وتتبع الحركة الأنيق.',
                'price' => 3100.00,
                'compare_price' => 3500.00,
                'stock' => 7,
                'sku' => 'AURA-WEA-002',
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=800&auto=format&fit=crop',
                'additional_images' => [],
                'is_featured' => true,
                'is_new' => true,
                'rating' => 4.90,
                'sales_count' => 21,
            ],
        ];

        foreach ($productsData as $prodData) {
            unset($prodData['slug_alt']);
            $p = Product::create($prodData);

            Review::create([
                'product_id' => $p->id,
                'user_id' => $customer->id,
                'rating' => rand(4, 5),
                'comment' => 'منتج فاخر للغاية، الجودة تتجاوز التوقعات والتغليف مذهل والخدمة سريعة جداً.',
                'is_approved' => true,
            ]);
        }

        // 4. Coupons
        Coupon::create([
            'code' => 'AURA20',
            'discount_percentage' => 20.00,
            'min_order_amount' => 500.00,
            'expires_at' => now()->addMonths(6),
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'LUXURY10',
            'discount_percentage' => 10.00,
            'min_order_amount' => 100.00,
            'expires_at' => now()->addYear(),
            'is_active' => true,
        ]);
    }
}
