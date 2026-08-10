<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Product;
use App\Models\SeoMeta;

class SeoService
{
    public function __construct(private readonly SettingsService $settings) {}

    /**
     * @return array<string, mixed>
     */
    public function forPageSlug(string $slug, string $fallbackTitle, ?string $fallbackDescription = null): array
    {
        $page = Page::where('slug', $slug)->with('seo')->first();

        return $this->build($page?->seo, $page?->title ?? $fallbackTitle, $fallbackDescription);
    }

    /**
     * @return array<string, mixed>
     */
    public function forProduct(Product $product): array
    {
        $data = $this->build($product->seo, $product->name, $product->short_description);
        $data['jsonLd'][] = $this->productSchema($product);

        return $data;
    }

    /**
     * @param  array<int, array<string, mixed>>  $extraJsonLd
     * @return array<string, mixed>
     */
    public function forTitle(string $title, ?string $description = null, array $extraJsonLd = []): array
    {
        return $this->build(null, $title, $description, $extraJsonLd);
    }

    /**
     * @param  array<int, array<string, mixed>>  $extraJsonLd
     * @return array<string, mixed>
     */
    private function build(?SeoMeta $seo, string $fallbackTitle, ?string $fallbackDescription = null, array $extraJsonLd = []): array
    {
        $title = $seo?->title ?: $fallbackTitle;
        $description = $seo?->meta_description ?: ($fallbackDescription ?: $this->defaultDescription());

        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $seo?->canonical_url ?: url()->current(),
            'ogTitle' => $seo?->og_title ?: $title,
            'ogDescription' => $seo?->og_description ?: $description,
            'ogImage' => $seo?->og_image,
            'robots' => $seo?->robots ?: 'index, follow',
            'jsonLd' => array_values(array_filter([
                $this->organizationSchema(),
                $seo?->schema_json,
                ...$extraJsonLd,
            ])),
        ];
    }

    private function defaultDescription(): string
    {
        return 'Borendra International is a Bangladesh-based registered exporting company supplying human hair, dressed hair, animal hair and synthetic materials for the global wig and hair industry.';
    }

    /**
     * @return array<string, mixed>
     */
    public function organizationSchema(): array
    {
        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Borendra International',
            'url' => url('/'),
            'email' => $this->settings->get('company_email') ?: null,
            'telephone' => $this->settings->get('company_phone') ?: null,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Dakshinkhan, Dhaka',
                'addressCountry' => 'BD',
            ],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function localBusinessSchema(): array
    {
        return [
            ...$this->organizationSchema(),
            '@type' => 'LocalBusiness',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name'),
            'url' => url('/'),
        ];
    }

    /**
     * @param  array<int, array{name: string, url: string}>  $items
     * @return array<string, mixed>
     */
    public function breadcrumbSchema(array $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)->values()->map(fn (array $item, int $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ])->all(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function productSchema(Product $product): array
    {
        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->short_description,
            'category' => $product->category?->name,
            'url' => route('products.show', $product),
            'image' => $product->featured_image,
        ]);
    }
}
