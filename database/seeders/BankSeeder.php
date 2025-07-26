<?php

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        Bank::insert([
            [
                'name' => 'Equity Bank',
                'type' => 'bank',
                'annual_rate' => 14.39,
                'rate_type' => 'reducing',
                'min_amount' => 10000,
                'max_amount' => 5000000,
                'min_months' => 6,
                'max_months' => 60,
            ],
            [
                'name' => 'KCB Bank',
                'type' => 'bank',
                'annual_rate' => 14.60,
                'rate_type' => 'reducing',
                'min_amount' => 10000,
                'max_amount' => 5000000,
                'min_months' => 6,
                'max_months' => 60,
            ],
            [
                'name' => 'Co‑operative Bank',
                'type' => 'bank',
                'annual_rate' => 14.50,
                'rate_type' => 'reducing',
                'min_amount' => 10000,
                'max_amount' => 5000000,
                'min_months' => 6,
                'max_months' => 60,
            ],
            [
                'name' => 'Mwalimu SACCO',
                'type' => 'sacco',
                'annual_rate' => 12.00,
                'rate_type' => 'reducing',
                'min_amount' => 50000,
                'max_amount' => 8000000,
                'min_months' => 12,
                'max_months' => 72,
            ],
            [
                'name' => 'Stima SACCO',
                'type' => 'sacco',
                'annual_rate' => 12.00,
                'rate_type' => 'reducing',
                'min_amount' => 20000,
                'max_amount' => 3000000,
                'min_months' => 6,
                'max_months' => 48,
            ],
            [
                'name' => 'Faulu Microfinance',
                'type' => 'bank',
                'annual_rate' => 16.00,
                'rate_type' => 'reducing',
                'min_amount' => 5000,
                'max_amount' => 1000000,
                'min_months' => 3,
                'max_months' => 36,
            ],
        ]);
    }
}
