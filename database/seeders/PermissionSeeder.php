<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Show Managers',
            'Add Managers',
            'Edit Managers',
            'Delete Managers',

            'Show Users',
            'Add Users',
            'Edit Users',
            'Delete Users',

            'Show Pharmacies',
            'Add Pharmacies',
            'Edit Pharmacies',
            'Delete Pharmacies',

            'Show Roles And Permissions',
            'Add Roles And Permissions',
            'Edit Roles And Permissions',

            'Add Timetables',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin','name' => $permission]);
        }
    }
}
