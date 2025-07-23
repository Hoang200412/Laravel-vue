<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityType::insert([
            ['name' => 'Viết bài hội thảo quốc gia', 'hour_equivalent' => 10],
            ['name' => 'Tham gia đề tài cấp khoa', 'hour_equivalent' => 15],
            ['name' => 'Đăng bài trên tạp chí quốc tế', 'hour_equivalent' => 20],
        ]);
    }
}
