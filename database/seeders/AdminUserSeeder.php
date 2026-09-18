<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@inobi.com'],
            [
                'name' => 'Admin INOBI',
                'password' => 'password123',
                'is_admin' => true,
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@inobi.com');
        $this->command->info('Password: password123');
    }
}
