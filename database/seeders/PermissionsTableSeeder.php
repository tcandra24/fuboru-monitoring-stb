<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'report.stb.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'report.stb.detail', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.users.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'setting.roles.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting.permissions.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'master.customers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.branches.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.divisions.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master.salesmans.index', 'guard_name' => 'web']);
    }
}
