<?php

namespace Database\Seeders;

use App\Models\RolePermissionModule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolePermissionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermissionModule::truncate();
        $rolePermissionModule = [
            [
                'module_name' => 'User Module',
                'module_type' => 'user',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
                    "edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Role Permission',
                'module_type' => 'role_permission',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Email Template',
                'module_type' => 'email_template',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Settings',
                'module_type' => 'settings',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Contact Us',
                'module_type' => 'contact_us',
                'permissions' => '{
                    "view": "View"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Cms Pages',
                'module_type' => 'cms_pages',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Activity Logs',
                'module_type' => 'activity_logs',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Slider',
                'module_type' => 'slider',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Test Report',
                'module_type' => 'test_report',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Health Concern',
                'module_type' => 'health_concern',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Package',
                'module_type' => 'package',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'module_name' => 'Cms Pages',
                'module_type' => 'cms_pages',
                'permissions' => '{
                    "view": "View",
                    "delete": "Delete",
                    "create": "Create",
					"edit": "Edit"
                }',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        RolePermissionModule::insert($rolePermissionModule);
    }
}
