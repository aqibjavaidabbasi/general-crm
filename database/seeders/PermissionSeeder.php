<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = ['media', 'blog', 'categories_blog', 'tags_blog', 'comments_blog', 'pages', 'users', 'roles', 'permissions'];
        $operations = ['create', 'edit', 'delete', 'show'];

        foreach ($modules as $module) {
            foreach ($operations as $operation) {
                $permissionName = $operation . '_' . $module;

                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create([
                        'name' => $permissionName,
                    ]);
                }
            }
        }
    }
}
