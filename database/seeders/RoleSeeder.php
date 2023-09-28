<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
  
    public function run(): void
    {
        /*
            admin => All
            developer=> 
            manager => 
        */ 
        $admin = Role::create(['name'=>'admin']);
        $developer = Role::create(['name'=>'developer']);
        $manager = Role::create(['name'=>'manager']);

        Permission::create(['name'=>'user.register'])->syncRoles([$admin]);
        Permission::create(['name'=>'user.login'])->syncRoles([$admin,$developer,$manager]);
        Permission::create(['name'=>'user.logout'])->syncRoles([$admin,$developer,$manager]);
        Permission::create(['name'=>'user.delete'])->syncRoles([$admin]);
        Permission::create(['name'=>'user.view.user'])->syncRoles([$admin,$developer,$manager]);
        Permission::create(['name'=>'blog.create'])->syncRoles([$developer,$manager]);
        Permission::create(['name'=>'blog.update'])->syncRoles([$developer,$manager]);
        Permission::create(['name'=>'blog.delete'])->assignRole($admin);
        Permission::create(['name'=>'blog.view'])->syncRoles([$admin,$developer,$manager]);
        Permission::create(['name'=>'blog.all'])->syncRoles([$admin]);

    }
}
