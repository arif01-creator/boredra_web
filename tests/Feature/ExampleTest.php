<?php

test('returns a successful response', function () {
    $response = $this->get(route('home', ['locale' => 'en']));

    $response->assertOk();
});
