<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for each resource
        $permissions = [
            // Student permissions
            'view_student',
            'view_any_student',
            'create_student',
            'update_student',
            'delete_student',
            'restore_student',
            'force_delete_student',

            // Teacher permissions
            'view_teacher',
            'view_any_teacher',
            'create_teacher',
            'update_teacher',
            'delete_teacher',
            'restore_teacher',
            'force_delete_teacher',

            // Subject permissions
            'view_subject',
            'view_any_subject',
            'create_subject',
            'update_subject',
            'delete_subject',
            'restore_subject',
            'force_delete_subject',

            // Grade permissions
            'view_grade',
            'view_any_grade',
            'create_grade',
            'update_grade',
            'delete_grade',
            'restore_grade',
            'force_delete_grade',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);

        // Assign all permissions to admin
        $admin->givePermissionTo(Permission::all());

        // Teacher permissions
        $teacher->givePermissionTo([
            'view_any_student',
            'view_student',
            'view_any_subject',
            'view_subject',
            'view_any_grade',
            'view_grade',
            'create_grade',
            'update_grade',
            'delete_grade',
        ]);

        // Student permissions
        $student->givePermissionTo([
            'view_any_subject',
            'view_subject',
            'view_grade',
        ]);
    }
}
