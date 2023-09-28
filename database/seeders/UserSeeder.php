<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make(12345678),
            'created_at'=>now(),
            'updated_at'=>now()
        ])->assignRole('admin');

        User::create([
            'name'=>'Jerry Tocto',
            'email'=>'jtocto@gmail.com',
            'password'=>Hash::make(12345678),
            'created_at'=>now(),
            'updated_at'=>now()
        ])->assignRole('manager');
    }
}
