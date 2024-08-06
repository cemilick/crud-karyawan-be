<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Job;
use App\Models\Karyawan;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Karyawan::factory(20)->create();
    }
}
