<?php

use App\Models\User;
use Illuminate\Support\Str;
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
            'role' => 1,
            'name' => 'Facts Admin',
            'email' => 'facts@mail.com',
            'password' => $password,
            'api_token' => Str::random(80)
        ]);
    }
}
