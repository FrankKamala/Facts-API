<?php

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::truncate();

        TransactionType::create([
            'type' => 'Withdraw'
        ]);

        TransactionType::create([
            'type' => 'Deposit'
        ]);
    }
}
