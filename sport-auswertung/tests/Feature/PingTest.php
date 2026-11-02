<?php

test('ping liefert status ok', function () {
    $response = $this->get('/ping');

    $response->assertStatus(200);
    $response->assertJson(['status' => 'ok']);
});