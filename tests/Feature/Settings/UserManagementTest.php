<?php

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Support\Facades\Session;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->beforeEach(function () {
        $this->seed(RoleAndPermissionSeeder::class);
        Session::start(); // Start the session to handle CSRF
    });

test('guests cannot edit users', function () {
    $user = User::factory()->create();
    
    $response = $this->get(route('admin.users.edit', $user->id));
    $response->assertRedirect(route('login'));
});

test('regular users cannot edit other users', function () {
    $regularUser = User::factory()->create();
    $regularUser->assignRole('user');
    $userToEdit = User::factory()->create();

    $this->actingAs($regularUser);
    
    $response = $this->get(route('admin.users.edit', $userToEdit->id));
    $response->assertStatus(403);
});

test('admin can access user edit page', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $userToEdit = User::factory()->create();

    $this->actingAs($admin);
    
    $response = $this->get(route('admin.users.edit', $userToEdit->id));
    $response->assertStatus(200);
});

test('admin can update user details', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $userToEdit = User::factory()->create();

    $this->actingAs($admin);
    
    $updatedData = [
        'name' => 'Updated Name',
        'surname' => 'Updated Surname',
        'email' => 'updated@example.com',
        'roles' => ['user'],
        '_token' => csrf_token() // Add CSRF token
    ];

    $response = $this->from(route('admin.users.edit', $userToEdit->id))
        ->put(route('admin.users.update', $userToEdit->id), $updatedData);
    
    $response->assertRedirect(route('admin.users'));
    $this->assertDatabaseHas('users', [
        'id' => $userToEdit->id,
        'name' => 'Updated Name',
        'surname' => 'Updated Surname',
        'email' => 'updated@example.com'
    ]);
});

test('admin cannot update user with invalid data', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $userToEdit = User::factory()->create();

    $this->actingAs($admin);
    
    $invalidData = [
        'name' => '', // name is required
        'email' => 'not-an-email',
        'roles' => ['invalid-role'],
        '_token' => csrf_token() // Add CSRF token
    ];

    $response = $this->from(route('admin.users.edit', $userToEdit->id))
        ->put(route('admin.users.update', $userToEdit->id), $invalidData);
    
    $response->assertSessionHasErrors(['name', 'email', 'roles.0']);
});

test('admin can delete user', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $userToDelete = User::factory()->create();

    $this->actingAs($admin);
    
    $response = $this->from(route('admin.users'))
        ->delete(route('admin.users.delete', $userToDelete->id), [
            '_token' => csrf_token() // Add CSRF token
        ]);
    
    $response->assertRedirect(route('admin.users'));
    $this->assertDatabaseMissing('users', ['id' => $userToDelete->id]);
});

test('regular users cannot delete other users', function () {
    $regularUser = User::factory()->create();
    $regularUser->assignRole('user');
    $userToDelete = User::factory()->create();

    $this->actingAs($regularUser);
    
    $response = $this->delete(route('admin.users.delete', $userToDelete->id), [
        '_token' => csrf_token() // Add CSRF token
    ]);
    
    $response->assertStatus(403);
    $this->assertDatabaseHas('users', ['id' => $userToDelete->id]);
});

test('admin cannot delete their own account', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin);
    
    $response = $this->delete(route('admin.users.delete', $admin->id), [
        '_token' => csrf_token() // Add CSRF token
    ]);
    
    $response->assertStatus(403);
    $this->assertDatabaseHas('users', ['id' => $admin->id]);
});