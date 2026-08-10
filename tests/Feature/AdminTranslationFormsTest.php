<?php

use App\Models\CompanyStat;
use App\Models\GlobalMarket;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\QualityProcess;
use App\Models\ResponsibilityItem;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::where('email', 'admin@borendra.com')->firstOrFail();
});

test('product create and edit forms render', function () {
    $product = Product::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.products.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.products.edit', $product))->assertOk();
});

test('category create and edit forms render', function () {
    $category = ProductCategory::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.categories.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.categories.edit', $category))->assertOk();
});

test('quality create and edit forms render', function () {
    $stage = QualityProcess::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.quality.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.quality.edit', $stage))->assertOk();
});

test('global reach create and edit forms render', function () {
    $market = GlobalMarket::create([
        'country' => 'Test Market',
        'description' => 'Test description',
        'latitude' => 1.23,
        'longitude' => 4.56,
        'status' => 'published',
        'display_order' => 0,
    ]);

    $this->actingAs($this->admin)->get(route('admin.global-reach.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.global-reach.edit', $market))->assertOk();
});

test('company stat create and edit forms render', function () {
    $stat = CompanyStat::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.company-stats.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.company-stats.edit', $stat))->assertOk();
});

test('responsibility create and edit forms render', function () {
    $item = ResponsibilityItem::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.responsibility.create'))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.responsibility.edit', $item))->assertOk();
});

test('every page edit form renders', function () {
    foreach (Page::all() as $page) {
        $this->actingAs($this->admin)->get(route('admin.pages.edit', $page))->assertOk();
    }
});

test('seo edit forms render for a page and a product', function () {
    $page = Page::firstOrFail();
    $product = Product::firstOrFail();

    $this->actingAs($this->admin)->get(route('admin.seo.edit', ['type' => 'page', 'id' => $page->id]))->assertOk();
    $this->actingAs($this->admin)->get(route('admin.seo.edit', ['type' => 'product', 'id' => $product->id]))->assertOk();
});

test('updating a product persists both en and bn translations for every translatable field', function () {
    $product = Product::firstOrFail();

    $this->actingAs($this->admin)->put(route('admin.products.update', $product), [
        'product_category_id' => $product->product_category_id,
        'name' => ['en' => 'Human Hair EN', 'bn' => 'হিউম্যান হেয়ার'],
        'slug' => $product->slug,
        'short_description' => ['en' => 'Short EN', 'bn' => 'সংক্ষিপ্ত'],
        'long_description' => ['en' => '<p>Long EN</p>', 'bn' => '<p>বিস্তারিত</p>'],
        'specifications' => [
            'en' => ['Material Type' => 'Remy', 'Source' => 'India'],
            'bn' => ['Material Type' => 'রেমি'],
        ],
        'applications' => [
            'en' => ['Wigs', 'Extensions'],
            'bn' => ['উইগ', 'এক্সটেনশন'],
        ],
        'status' => 'published',
        'sort_order' => 0,
    ])->assertRedirect(route('admin.products.index'));

    $product->refresh();

    expect($product->getTranslation('name', 'en', false))->toBe('Human Hair EN');
    expect($product->getTranslation('name', 'bn', false))->toBe('হিউম্যান হেয়ার');
    expect($product->getTranslation('short_description', 'bn', false))->toBe('সংক্ষিপ্ত');
    expect($product->getTranslation('long_description', 'bn', false))->toBe('<p>বিস্তারিত</p>');
    expect($product->getTranslation('specifications', 'en', false))->toBe(['Material Type' => 'Remy', 'Source' => 'India']);
    expect($product->getTranslation('specifications', 'bn', false))->toBe(['Material Type' => 'রেমি']);
    expect($product->getTranslation('applications', 'en', false))->toBe(['Wigs', 'Extensions']);
    expect($product->getTranslation('applications', 'bn', false))->toBe(['উইগ', 'এক্সটেনশন']);
});

test('leaving bn blank on a product falls back to en on read', function () {
    $product = Product::firstOrFail();

    $this->actingAs($this->admin)->put(route('admin.products.update', $product), [
        'product_category_id' => $product->product_category_id,
        'name' => ['en' => 'English Only Name', 'bn' => ''],
        'slug' => $product->slug,
        'short_description' => ['en' => '', 'bn' => ''],
        'long_description' => ['en' => '', 'bn' => ''],
        'status' => 'published',
        'sort_order' => 0,
    ])->assertRedirect(route('admin.products.index'));

    $product->refresh();

    expect($product->getTranslation('name', 'bn', false))->toBe('');
    app()->setLocale('bn');
    expect($product->name)->toBe('English Only Name');
    app()->setLocale('en');
});

test('updating a page persists sections for both locales', function () {
    $page = Page::where('slug', 'about')->firstOrFail();

    $this->actingAs($this->admin)->put(route('admin.pages.update', $page), [
        'sections' => [
            'en' => ['heading' => 'EN Heading', 'body' => 'EN Body'],
            'bn' => ['heading' => 'বাং হেডিং', 'body' => ''],
        ],
    ])->assertRedirect(route('admin.pages.index'));

    $page->refresh();

    expect($page->getTranslation('sections', 'en', false))->toBe(['heading' => 'EN Heading', 'body' => 'EN Body']);
    expect($page->getTranslation('sections', 'bn', false))->toBe(['heading' => 'বাং হেডিং']);
});

test('updating seo persists translated title and meta description', function () {
    $product = Product::firstOrFail();

    $this->actingAs($this->admin)->put(route('admin.seo.update', ['type' => 'product', 'id' => $product->id]), [
        'title' => ['en' => 'SEO Title EN', 'bn' => 'এসইও শিরোনাম'],
        'meta_description' => ['en' => 'Meta EN', 'bn' => ''],
    ])->assertRedirect(route('admin.seo.index'));

    $seo = $product->fresh()->seo;

    expect($seo->getTranslation('title', 'en', false))->toBe('SEO Title EN');
    expect($seo->getTranslation('title', 'bn', false))->toBe('এসইও শিরোনাম');
    expect($seo->getTranslation('meta_description', 'bn', false))->toBe('');
});
