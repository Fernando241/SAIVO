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

        Permission::create(['name' => 'adminDashboard'])->assignRole($role1);
        Permission::create(['name' => 'users.index'])->assignRole($role1);
        Permission::create(['name' => 'users.edit'])->assignRole($role1);

        Permission::create(['name' => 'pedidos.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'pedidos.edit'])->assignRole($role1);
        /* necesito crear una pestaña donde el usuario pueda ver solo sus pedidos realizados y saber el estado del mismo */

        Permission::create(['name' => 'adminProducts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.edit'])->assignRole($role1);
        Permission::create(['name' => 'productos.create'])->assignRole($role1);
        Permission::create(['name' => 'productos.destroy'])->assignRole($role1);

        Permission::create(['name' => 'inventario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'contabilidad'])->assignRole($role1);

        Permission::create(['name' => 'clientes.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.edit'])->assignRole($role1);
        Permission::create(['name' => 'clientes.destroy'])->assignRole($role1);

        Permission::create(['name' => 'recetas.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'recetas.edit'])->assignRole($role1);
        Permission::create(['name' => 'recetas.destroy'])->assignRole($role1);
    }
}
