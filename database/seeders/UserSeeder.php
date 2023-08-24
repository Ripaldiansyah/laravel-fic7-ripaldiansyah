<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory(30)->create();
       User::create([
        'name'=>'Ripaldiansyah',
        'email'=>'Ripaldiansyah@gmail.com',
        'email_verified_at'=> now(),
        'role' => 'admin',
        'password'=>Hash::make('Password123'),
        'phone' => "6281234",
        'bio' => 'Ini Bio',
       ]);
       User::create([
        'name'=>'SuperAdmin',
        'email'=>'SuperAdmin@gmail.com',
        'email_verified_at'=> now(),
        'role' => 'superadmin',
        'password'=>Hash::make('123456'),
        'phone' => "62812345",
        'bio' => 'Ini Bio loh',
       ]);
    }
}
