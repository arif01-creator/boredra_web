<?php

use App\Models\Product;
use Illuminate\Testing\TestResponse;

function inertiaPayload(TestResponse $response): array
{
    $content = $response->getContent();
    $jsonStart = strpos($content, '>{', strpos($content, 'application/json')) + 1;
    $jsonEnd = strpos($content, '</script>', $jsonStart);

    return json_decode(substr($content, $jsonStart, $jsonEnd - $jsonStart), true);
}

beforeEach(function () {
    $this->product = Product::firstOrFail();
    $this->product->setTranslation('name', 'bn', 'বাংলা নাম');
    $this->product->setTranslation('specifications', 'en', ['Material Type' => 'Remy']);
    $this->product->save();
});

test('product name serializes to a plain english string on the en route', function () {
    $payload = inertiaPayload($this->get('/en/products/'.$this->product->slug)->assertOk());

    expect($payload['props']['product']['name'])->toBe('Human Hair');
});

test('product name serializes to a plain bengali string on the bn route', function () {
    $payload = inertiaPayload($this->get('/bn/products/'.$this->product->slug)->assertOk());

    expect($payload['props']['product']['name'])->toBe('বাংলা নাম');
});

test('array-shaped translatable fields keep their array shape after locale resolution', function () {
    $payload = inertiaPayload($this->get('/en/products/'.$this->product->slug)->assertOk());

    expect($payload['props']['product']['specifications'])->toBe(['Material Type' => 'Remy']);
});

test('product listing serializes plain names for every item', function () {
    $payload = inertiaPayload($this->get('/en/products')->assertOk());

    foreach ($payload['props']['products'] as $product) {
        expect($product['name'])->toBeString();
        expect($product['category']['name'] ?? null)->not->toBeArray();
    }
});
