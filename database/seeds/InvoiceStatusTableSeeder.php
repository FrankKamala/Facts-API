<?php

use App\Models\InvoiceStatus;
use Illuminate\Database\Seeder;

class InvoiceStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceStatus::truncate();

        InvoiceStatus::create([
            'status' => 'Pending',
            'description' => 'Your invoice is waiting buyer approval.'
        ]);

        InvoiceStatus::create([
            'status' => 'Approved',
            'description' => 'Your invoice has been approved by the buyer.'
        ]);

        InvoiceStatus::create([
            'status' => 'Rejected',
            'description' => 'Your invoice has been rejected by the buyer.'
        ]);
    }
}
