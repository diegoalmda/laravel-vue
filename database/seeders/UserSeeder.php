<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use WithoutModelEvents;

    public function run(): void
    {
        $this->validateEnvVariables();

        User::insert([
            [
                'name' => 'Admin',
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'is_admin' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Reader',
                'email' => 'reader@example.com',
                'password' => Hash::make(env('READER_PASSWORD')),
                'is_admin' => false,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    protected function validateEnvVariables(): void
    {
        if (empty(env('ADMIN_PASSWORD'))) {
            throw new \RuntimeException('Variável ADMIN_PASSWORD não definida no .env');
        }

        if (empty(env('READER_PASSWORD'))) {
            throw new \RuntimeException('Variável READER_PASSWORD não definida no .env');
        }
    }
}
