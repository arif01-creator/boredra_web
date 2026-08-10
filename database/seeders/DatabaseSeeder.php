<?php

namespace Database\Seeders;

use App\Models\CompanyStat;
use App\Models\GlobalMarket;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\QualityProcess;
use App\Models\ResponsibilityItem;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedAdmin();
        $this->seedProductCatalogue();
        $this->seedQualityProcess();
        $this->seedPages();
        $this->seedCompanyStats();
        $this->seedResponsibilityItems();
        $this->seedSiteSettings();

        // No export destinations are seeded — Global Reach markets must be
        // added by an administrator once verified destinations are confirmed.
        GlobalMarket::query();
    }

    private function seedAdmin(): void
    {
        $password = (string) env('SEED_ADMIN_PASSWORD', Str::password(16));

        User::updateOrCreate(
            ['email' => 'admin@borendra.com'],
            [
                'name' => 'Borendra Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        $this->command?->warn("Seeded admin login → admin@borendra.com / {$password}");
    }

    private function seedProductCatalogue(): void
    {
        $items = [
            [
                'name' => 'Human Hair',
                'short' => 'Premium human hair materials for international wig and hair-product manufacturers.',
                'long' => 'Borendra International sources and supplies human hair materials for manufacturers producing wigs and hair products for international markets. Detailed specifications and available forms are confirmed on request.',
            ],
            [
                'name' => 'Dressed Hair',
                'short' => 'Processed and prepared hair materials for specialized applications.',
                'long' => 'Dressed hair materials are prepared for specialized applications within the wig and hair-product industry. Processing details and available specifications are provided by our team on request.',
            ],
            [
                'name' => 'Animal Hair',
                'short' => 'Selected animal hair materials for appropriate industrial and specialized applications.',
                'long' => 'Borendra International supplies selected animal hair materials for appropriate industrial and specialized applications. Sourcing and specification details are confirmed with each inquiry.',
            ],
            [
                'name' => 'Synthetic Materials',
                'short' => 'Synthetic fibers and materials used in wigs and related hair products.',
                'long' => 'A range of synthetic fibers and materials for use in wigs and related hair products, supplied to manufacturers and distributors internationally. Full specifications are confirmed on request.',
            ],
        ];

        foreach ($items as $index => $item) {
            $slug = Str::slug($item['name']);

            $category = ProductCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'],
                    'description' => $item['short'],
                    'sort_order' => $index,
                    'status' => 'published',
                ],
            );

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'product_category_id' => $category->id,
                    'name' => $item['name'],
                    'short_description' => $item['short'],
                    'long_description' => $item['long'],
                    'specifications' => [
                        'Material Type' => null,
                        'Source' => null,
                        'Processing' => null,
                        'Texture' => null,
                        'Available Forms' => null,
                        'Packaging' => null,
                    ],
                    'applications' => [],
                    'status' => 'published',
                    'sort_order' => $index,
                ],
            );
        }
    }

    private function seedQualityProcess(): void
    {
        $stages = [
            ['Sourcing', 'Materials are sourced with care and attention to origin.'],
            ['Selection', 'Selected materials are assessed before moving further into the process.'],
            ['Preparation', 'Materials are prepared for the applications they are intended for.'],
            ['Quality Control', 'Quality checks are carried out prior to packaging and export.'],
            ['Packaging', 'Materials are packaged appropriately for international shipment.'],
            ['Export', 'Orders are prepared and exported to international partners.'],
        ];

        foreach ($stages as $index => [$title, $description]) {
            QualityProcess::updateOrCreate(
                ['title' => $title],
                [
                    'description' => $description,
                    'sort_order' => $index,
                    'status' => 'published',
                ],
            );
        }
    }

    private function seedPages(): void
    {
        $pages = [
            [
                'slug' => 'home-intro',
                'title' => 'Who We Are',
                'sections' => [
                    'label' => 'WHO WE ARE',
                    'heading' => "A trusted connection\nbetween quality materials\nand global markets.",
                    'body' => 'Borendra International is a registered exporting company based in Dakshinkhan, Dhaka, Bangladesh, supplying human hair, dressed hair, animal hair and synthetic materials to the international wig and hair-product industry.',
                ],
            ],
            [
                'slug' => 'about',
                'title' => 'About',
                'sections' => [
                    'heading' => "Built on Quality.\nDriven by Trust.",
                    'body' => 'Borendra International is a registered exporting company based in Dakshinkhan, Dhaka, Bangladesh. We work with international partners across the wig and hair-product industry, supplying human hair, dressed hair, animal hair and synthetic materials.',
                ],
            ],
            [
                'slug' => 'company-profile',
                'title' => 'Company Profile',
                'sections' => [
                    'legal_name' => 'Borendra International',
                    'business_type' => 'Registered Exporting Company',
                    'address' => 'Dakshinkhan, Dhaka, Bangladesh',
                ],
            ],
            [
                'slug' => 'responsibility',
                'title' => 'Responsible by Approach',
                'sections' => [
                    'heading' => "RESPONSIBLE\nBY APPROACH.",
                    'enabled' => false,
                ],
            ],
            [
                'slug' => 'privacy',
                'title' => 'Privacy Policy',
                'sections' => [
                    'body' => "This Privacy Policy explains how Borendra International collects and uses information submitted through this website, including inquiry form submissions. Add the full policy text via Admin → Pages.",
                ],
            ],
            [
                'slug' => 'terms',
                'title' => 'Terms of Service',
                'sections' => [
                    'body' => 'These Terms of Service govern the use of this website. Add the full terms text via Admin → Pages.',
                ],
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], [
                'title' => $page['title'],
                'sections' => $page['sections'],
            ]);
        }
    }

    private function seedCompanyStats(): void
    {
        $stats = [
            ['Based In', 'Dhaka, Bangladesh'],
            ['Market Focus', 'International B2B'],
            ['Material Categories', '4'],
        ];

        foreach ($stats as $index => [$label, $value]) {
            CompanyStat::updateOrCreate(
                ['label' => $label],
                ['value' => $value, 'sort_order' => $index, 'status' => 'published'],
            );
        }
    }

    private function seedResponsibilityItems(): void
    {
        $topics = [
            'Responsible sourcing',
            'Material traceability',
            'Quality-focused processing',
            'Packaging',
            'Waste reduction',
            'Supplier relationships',
        ];

        foreach ($topics as $index => $title) {
            ResponsibilityItem::updateOrCreate(
                ['title' => $title],
                [
                    'description' => 'Add verified detail via Admin → Responsibility.',
                    'sort_order' => $index,
                    'status' => 'published',
                ],
            );
        }
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            'company_name' => 'Borendra International',
            'company_address' => 'Dakshinkhan, Dhaka, Bangladesh',
            'company_phone' => '',
            'company_email' => '',
            'company_profile_pdf' => '',
            'social_facebook' => '',
            'social_linkedin' => '',
            'social_instagram' => '',
            'responsibility_section_enabled' => '0',
            'hero_media' => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
