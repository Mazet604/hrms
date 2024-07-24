<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'empid' => '11-0070',
            'emp_email' => 'jgmatugas117@gmail.com',
            'emp_user' => 'jgmatugas',
            'emp_pass' => Hash::make('matugas@2023'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
