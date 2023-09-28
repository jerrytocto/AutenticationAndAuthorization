<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Creación de roles 
        $this->call(RoleSeeder::class);

        //Usuarios base 
        $this->call(UserSeeder::class);

        //Creación de usuarios con los factories
        User::factory(10)->create()->each(function ($user){
            $user->assignRole('developer');
        });
    }
}
