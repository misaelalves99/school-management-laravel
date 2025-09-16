<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria usuário de teste apenas se não existir
        User::updateOrCreate(
            ['email' => 'test@example.com'], // chave única
            [
                'name' => 'Test User',
                'password' => Hash::make('12345678'), // define senha segura
            ]
        );

        // Exemplo: criar mais usuários de teste usando factories
        // User::factory(10)->create();
    }
}
