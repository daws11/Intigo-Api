<?php

namespace Database\Seeders;
use App\Models\Meeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run()
    {
        Meeting::factory()->count(10)->create(); // Membuat 10 meeting
    }
}
