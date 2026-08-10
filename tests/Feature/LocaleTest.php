<?php

test('the bare root redirects to the English site by default', function () {
    $this->get('/')->assertRedirect('/en');
});

test('the bare root redirects to a previously chosen locale cookie', function () {
    $this->withCookie('locale', 'bn')->get('/')->assertRedirect('/bn');
});

test('an unsupported locale segment 404s', function () {
    $this->get('/fr/about')->assertNotFound();
});

test('visiting a locale-prefixed page sets the locale cookie', function () {
    $response = $this->get('/bn/about');

    $response->assertOk();
    $response->assertCookie('locale', 'bn');
});

test('the html lang attribute matches the active locale', function () {
    $this->get('/bn/about')->assertSee('lang="bn"', false);
    $this->get('/en/about')->assertSee('lang="en"', false);
});
