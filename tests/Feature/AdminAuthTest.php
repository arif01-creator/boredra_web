<?php

use App\Models\User;

test('guests are redirected to the admin login page', function () {
    $this->get('/admin')->assertRedirect(route('admin.login'));
});

test('an admin can log in and reach the dashboard', function () {
    $response = $this->post(route('admin.login.store'), [
        'email' => 'admin@borendra.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticated();
});

test('a non-admin user cannot access the admin area', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)->get('/admin')->assertForbidden();
});

test('invalid credentials are rejected', function () {
    $response = $this->post(route('admin.login.store'), [
        'email' => 'admin@borendra.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});
