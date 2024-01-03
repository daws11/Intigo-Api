<?php

namespace Database\Seeders;
use App\Models\Creator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatorSeeder extends Seeder
{
    public function run()
    {
        Creator::factory()->count(10)->create(); 
    }
}
