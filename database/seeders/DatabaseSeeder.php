<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(Adminseeder::class);

        User::factory(5)->create([
            
            "role" => fn () => rand(1,2),
            
        ]);

        Patient::factory(25)->create([
            "patient_code" => fn () => $this->patient_code(),
        ]);
    }

    public function patient_code()
    {
        $period = now()->format('Ym');
        
        return "PX-" . $period . rand(1000,9999);
    }
}
