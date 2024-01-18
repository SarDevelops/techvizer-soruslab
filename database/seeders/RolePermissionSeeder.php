<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RolePermissionModule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_permissions_module = RolePermissionModule::get();
        $role = Role::where('role_name', 'admin')->first();
        RolePermission::truncate();
        foreach ($role_permissions_module as $role_permission_module) {
            $role_permission = new RolePermission();
            $role_permission->role_id = $role->id;
            $role_permission->permissions = json_encode(array_fill_keys(array_keys(json_decode($role_permission_module->permissions, true)), 1));
            $role_permission->module_id = $role_permission_module->id;
            $role_permission->created_at = Carbon::now();
            $role_permission->updated_at = Carbon::now();
            $role_permission->save();
        }
    }
}
