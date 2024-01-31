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
        $role= Role::Create(['name' => 'admin']);
        $permissions = [
          ['name' => 'todo.list'],
          ['name' => 'todo.create'],
          ['name' => 'todo.edit'],
          ['name' => 'todo.delete'],
      
          ['name' => 'brand.list'],
          ['name' => 'brand.create'],
          ['name' => 'brand.edit'],
          ['name' => 'brand.delete'],
      
          ['name' => 'model.list'],
          ['name' => 'model.create'],
          ['name' => 'model.edit'],
          ['name' => 'model.delete'],
      
          ['name' => 'item.list'],
          ['name' => 'item.create'],
          ['name' => 'item.edit'],
          ['name' => 'item.delete'],
      
          ['name' => 'role.list'],
          ['name' => 'role.create'],
          ['name' => 'role.edit'],
          ['name' => 'role.delete'],
      
          ['name' => 'user.list'],
          ['name' => 'user.create'],
          ['name' => 'user.edit'],
          ['name' => 'user.delete'],

          ['name' => 'student.list'],
          ['name' => 'student.create'],
          ['name' => 'student.edit'],
          ['name' => 'student.delete'],
          ['name' => 'student.import'],
          ['name' => 'student.export'],
      ];
      
      foreach ($permissions as $item) {
          Permission::create($item);
      }
      
        $role->syncPermissions(Permission::all());

        $user =User::first();
        $user->assignRole($role);
    }
}
