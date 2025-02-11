<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        // Seed login data
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        // Seed category data
        DB::table('categories')->insert([
            [
                'name' => 'General',
                'description' => 'General category',
                'is_default' => true,
            ],
            [
                'name' => 'Work',
                'description' => 'Work related category',
                'is_default' => true,
            ],
            [
                'name' => 'Personal',
                'description' => 'Personal category',
                'is_default' => true,
            ],
        ]);

        // Seed wallet data
        DB::table('wallets')->insert([
            [
                'name' => 'Cash',
                'balance' => 10000.00,
                'user_id' => 1,
                'color_hex' => '#d12e2e',
                'emoji' => '🪙',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BCA',
                'balance' => 700000.00,
                'user_id' => 1,
                'color_hex' => '#2713be',
                'emoji' => '🏧',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed transaction data
        DB::table('transactions')->insert([
            [
                'type' => 'expense',
                'amount' => 15000.00,
                'description' => 'Warteg',
                'tx_date' => now(),
                'wallet_id' => 1,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'income',
                'amount' => 150000.00,
                'description' => 'Salary',
                'tx_date' => now(),
                'wallet_id' => 2,
                'category_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}