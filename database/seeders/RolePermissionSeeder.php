<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role= Role::firstOrCreate(['name' => 'admin']);
         // Todo Permissions
         Permission::firstOrCreate(['name' => 'tod.list']);
         Permission::firstOrCreate(['name' => 'todo.create']);
         Permission::firstOrCreate(['name' => 'todo.edit']);
         Permission::firstOrCreate(['name' => 'todo.delete']);
 
         // Brand Permissions
         Permission::firstOrCreate(['name' => 'brand.list']);
         Permission::firstOrCreate(['name' => 'brand.create']);
         Permission::firstOrCreate(['name' => 'brand.edit']);
         Permission::firstOrCreate(['name' => 'brand.delete']);

          // Model Permissions
          Permission::firstOrCreate(['name' => 'model.list']);
          Permission::firstOrCreate(['name' => 'model.create']);
          Permission::firstOrCreate(['name' => 'model.edit']);
          Permission::firstOrCreate(['name' => 'model.delete']); 

        // Item Permissions
         Permission::firstOrCreate(['name' => 'item.list']);
         Permission::firstOrCreate(['name' => 'item.create']);
         Permission::firstOrCreate(['name' => 'item.edit']);
         Permission::firstOrCreate(['name' => 'item.delete']);
         // ToDo: Add more permissions dynamically with AH
 
         // Role Permissions
         Permission::firstOrCreate(['name' => 'role.list']);
         Permission::firstOrCreate(['name' => 'role.create']);
         Permission::firstOrCreate(['name' => 'role.edit']);
         Permission::firstOrCreate(['name' => 'role.delete']);

          // Users Permissions
          Permission::firstOrCreate(['name' => 'user.list']);
          Permission::firstOrCreate(['name' => 'user.create']);
          Permission::firstOrCreate(['name' => 'user.edit']);
          Permission::firstOrCreate(['name' => 'user.delete']);

        $role->syncPermissions(Permission::all());

        $user =User::first();
        $user->assignRole($role);
    }
}
