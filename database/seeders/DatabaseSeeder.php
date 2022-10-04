<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $developerRole = Role::create(['name' => 'Developer']);
        $clientRole = Role::create(['name' => 'Client']);

        Permission::create(['name' => 'see-all-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'see-all-tickets']);
        Permission::create(['name' => 'create-tickets']);
        Permission::create(['name' => 'edit-tickets']);
        Permission::create(['name' => 'delete-tickets']);

        $adminRole->givePermissionTo([
            'see-all-users',
            'delete-users',
            'delete-tickets',
        ]);

        $clientRole->givePermissionTo([
            'create-tickets',
            'see-all-tickets',
            'edit-tickets',
            'delete-tickets',
        ]);
        $developerRole->givePermissionTo([
            'edit-tickets',
            'see-all-tickets'
        ]);

        $dataPriority = [
            ['id' => 1, 'priority' => 'High'],
            ['id' => 2, 'priority' => 'Medium'],
            ['id' => 3, 'priority' => 'Low'],
        ];

        $dataStatus = [
            ['id' => 1, 'status' => 'In Progress'],
            ['id' => 2, 'status' => 'Complete'],
            ['id' => 3, 'status' => 'Backlog'],
        ];

        $dataCategory = [
            ['id' => 1, 'category_type' => 'Invoke'],
            ['id' => 2, 'category_type' => 'Adnexio'],
            ['id' => 3, 'category_type' => 'Decoris'],
        ];

        DB::table('priorities')->insert($dataPriority);
        DB::table('statuses')->insert($dataStatus);
        DB::table('categories')->insert($dataCategory);
    }
}