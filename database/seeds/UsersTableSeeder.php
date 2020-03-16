<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $password = Hash::make('password');
        User::create([
            'name' => 'Facts Admin',
            'email' => 'facts@mail.com',
            'password' => $password
        ]);
    }
}
