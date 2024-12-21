<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'productos.edit'])->assignRole($role1);
        Permission::create(['name' => 'productos.create'])->assignRole($role1);
        Permission::create(['name' => 'productos.destroy'])->assignRole($role1);

        
    }
}
