<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

uses(
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
)->beforeEach(function () {
    $this->withoutExceptionHandling();
});

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {

    $token = Str::random(40);

    $user = User::factory()->create([
        'name' => 'Name',
        'surname' => 'Surname',
        'email' => 'test@example.com',
        'password' => Hash::make('password')
    ]);

    $response = $this
        ->withSession(['_token' => $token])
        ->withCookie('XSRF-TOKEN', $token)
        ->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            '_token' => $token
        ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('user.index', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $token = Str::random(40);
    $user = User::factory()->create();

    try {
        $this
            ->withSession(['_token' => $token])
            ->withCookie('XSRF-TOKEN', $token)
            ->post('/login', [
                'email' => $user->email,
                'password' => 'wrong-password',
                '_token' => $token
            ]);
    } catch (Throwable $th) {
        $this->assertGuest();
        $this->assertEquals('These credentials do not match our records.', $th->getMessage());
    }
});

test('users can logout', function () {
    $token = Str::random(40);
    $user = User::factory()->create();

    $response = $this
        ->withSession(['_token' => $token])
        ->withCookie('XSRF-TOKEN', $token)
        ->actingAs($user)
        ->post('/logout', ['_token' => $token]);

    $this->assertGuest();
});
