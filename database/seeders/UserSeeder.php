<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@contoso.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Jan',
            'surname' => 'Kowalski',
            'email' => 'user@contoso.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('user');
    }
}