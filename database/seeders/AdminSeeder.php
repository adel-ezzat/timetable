<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123456',
            'role_id' => 1,      
        ]);
    
        $role = Role::create(['name' => 'Manager', 'guard_name' => 'admin',]);
        // $admin->syncRoles('superAdmin');

        $permissions =  Permission::all();
        $role->syncPermissions($permissions);
        $admin->assignRole($role->id);
    }
}
