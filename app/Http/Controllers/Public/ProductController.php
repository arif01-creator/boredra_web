<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\SeoService;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(string $locale, SeoService $seo): Response
    {
        return Inertia::render('products/index', [
            'products' => Product::with('category')->where('status', 'published')->orderBy('sort_order')->get(),
            'seo' => $seo->forTitle('Our Materials — Human Hair, Dressed Hair, Animal Hair & Synthetic Materials'),
        ]);
    }

    /**
     * The leading $locale parameter keeps positional argument resolution
     * correct: Laravel's ControllerDispatcher resolves method arguments by
     * position once any container-injected dependency is spliced in, and
     * with an extra unconsumed {locale} route segment ahead of {product}
     * it would otherwise bind $product to the locale string instead of the
     * model. See ResolvesRouteDependencies::resolveMethodDependencies().
     */
    public function show(string $locale, Product $product, SeoService $seo): Response
    {
        abort_unless($product->status === 'published', 404);

        $related = Product::where('status', 'published')
            ->where('id', '!=', $product->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return Inertia::render('products/show', [
            'product' => $product->load(['category', 'images']),
            'related' => $related,
            'seo' => $seo->forProduct($product),
        ]);
    }
}
