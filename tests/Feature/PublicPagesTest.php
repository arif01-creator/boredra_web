<?php

use App\Models\Product;

test('all primary public pages load successfully in each locale', function (string $locale, string $route) {
    $this->get("/{$locale}{$route}")->assertOk();
})->with([
    ['en', '/'],
    ['en', '/about'],
    ['en', '/products'],
    ['en', '/quality'],
    ['en', '/global-reach'],
    ['en', '/company-profile'],
    ['en', '/contact'],
    ['en', '/privacy'],
    ['en', '/terms'],
    ['bn', '/'],
    ['bn', '/about'],
    ['bn', '/products'],
    ['bn', '/quality'],
    ['bn', '/global-reach'],
    ['bn', '/company-profile'],
    ['bn', '/contact'],
    ['bn', '/privacy'],
    ['bn', '/terms'],
]);

test('a published product detail page loads', function () {
    $product = Product::where('status', 'published')->firstOrFail();

    $this->get("/en/products/{$product->slug}")->assertOk();
});

test('an unknown page returns a 404', function () {
    $this->get('/en/products/does-not-exist')->assertNotFound();
});
