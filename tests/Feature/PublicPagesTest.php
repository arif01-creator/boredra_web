<?php

use App\Models\Product;

test('all primary public pages load successfully', function (string $route) {
    $this->get($route)->assertOk();
})->with([
    '/',
    '/about',
    '/products',
    '/quality',
    '/global-reach',
    '/company-profile',
    '/contact',
    '/privacy',
    '/terms',
]);

test('a published product detail page loads', function () {
    $product = Product::where('status', 'published')->firstOrFail();

    $this->get("/products/{$product->slug}")->assertOk();
});

test('an unknown page returns a 404', function () {
    $this->get('/products/does-not-exist')->assertNotFound();
});
