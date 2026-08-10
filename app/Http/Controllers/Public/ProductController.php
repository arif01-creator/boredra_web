<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('products/index');
    }

    public function show(Product $product): Response
    {
        return Inertia::render('products/show', [
            'slug' => $product->slug,
        ]);
    }
}
