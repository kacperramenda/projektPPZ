<?php

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->beforeEach(function () {
        $this->seed(RoleAndPermissionSeeder::class);
    });

test('guests are redirected to the login page', function () {
    $response = $this->get(route('admin.dashboard'));
    $response->assertRedirect(route('login'));
});

test('admin can visit the admin dashboard', function () {
    $user = User::factory()->create();
    $user->assignRole('admin');
    $this->actingAs($user);

    $response = $this->get(route('admin.dashboard'));
    $response->assertStatus(200);
});

test('regular users cannot visit the admin dashboard', function () {
    $user = User::factory()->create();
    $user->assignRole('user');
    $this->actingAs($user);

    $response = $this->get(route('admin.dashboard'));
    $response->assertStatus(403);
});


test('guests cannot access users index', function () {
    $response = $this->get(route('admin.users'));
    $response->assertRedirect(route('login'));
});

test('admin can access users index', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    
    $this->actingAs($admin);
    
    $response = $this->get(route('admin.users'));
    $response->assertStatus(200);
});

test('regular users cannot access users index', function () {
    $user = User::factory()->create();
    $user->assignRole('user');
    
    $this->actingAs($user);
    
    $response = $this->get(route('admin.users'));
    $response->assertStatus(403);
});

test('admin can see users list', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    
    $users = User::factory()->count(3)->create();
    
    $this->actingAs($admin);
    
    $response = $this->get(route('admin.users'));
    $response->assertStatus(200);
});