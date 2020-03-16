<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'role' => 'Admin',
            'description' => 'Admin User'
        ]);

        Role::create([
            'role' => 'Supplier',
            'description' => 'Supplier User'
        ]);

        Role::create([
            'role' => 'Buyer',
            'description' => 'Buyer User'
        ]);
    }
}
