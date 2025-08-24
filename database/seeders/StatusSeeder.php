<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_status')->insert([
            ['name' => 'Hoạt động'],
            ['name' => 'Khóa'],
            ['name' => 'Đang chờ'],
            ['name' => 'Đã xóa'],
            ['name' => 'Bị cấm'],
        ]);
    }
}
