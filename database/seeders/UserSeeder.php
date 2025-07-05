<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'username' => 'Truong',
            'name' => 'Le Manh Truong',
            'email' => 'truong@gmail.com',
            'password' => Hash::make('123456'),
            'department_id' => 2,
            'status_id' => 2,
            'avata' => 'avatar/avatar-default.jpg'
        ]);
    }
}
