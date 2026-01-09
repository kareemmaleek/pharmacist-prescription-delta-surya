<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "role" => 0,
            "name" => "Kareem Maleek",
            "username" => "kareemmaleek",
            "email" => "musafeerbinmalik@gmail.com",
            "password" => Hash::make(config('seeder.default_password'))
        ]);
    }
}
