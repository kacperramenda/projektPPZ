<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class, WithoutMiddleware::class)->beforeEach(function () {
    $this->withoutExceptionHandling();
});

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $userData = [
        'name' => 'Name',
        'surname' => 'Surname',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->withSession(['_token' => 'test-token'])
                    ->withCookie('XSRF-TOKEN', 'test-token')
                    ->post('/register', $userData);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});