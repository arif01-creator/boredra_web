<?php

use App\Models\Inquiry;
use Illuminate\Support\Facades\Notification;

test('a visitor can submit a valid inquiry', function () {
    Notification::fake();

    $response = $this->post('/contact', [
        'name' => 'Jane Buyer',
        'email' => 'jane@buyer-co.com',
        'message' => 'Interested in a sample order.',
    ]);

    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('inquiries', [
        'name' => 'Jane Buyer',
        'email' => 'jane@buyer-co.com',
        'status' => 'new',
    ]);
});

test('an inquiry requires name, email and message', function () {
    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
    expect(Inquiry::count())->toBe(0);
});

test('the honeypot field silently rejects bot submissions', function () {
    $response = $this->post('/contact', [
        'name' => 'Bot',
        'email' => 'bot@example.com',
        'message' => 'Spam',
        'website' => 'https://spam.example.com',
    ]);

    $response->assertSessionHasErrors('website');
    expect(Inquiry::count())->toBe(0);
});
