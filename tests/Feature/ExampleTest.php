<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->issue('1502');
