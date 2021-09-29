<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\service_order::factory(10)->create();

        User::create([
            'name' => 'Junior Gucciardo',
            'email' => 'juniorgucciardo1@gmail.com',
            'password' => Hash::make('juniorjunior')
        ]);

        $role = Role::create(['name' => 'administrator']);

        Permission::create([
            'name' => 'view_service_demands'
        ]);

        $role->givePermissionTo('view_service_demands');

        $user = User::find(1);
        $user->assignRole('administrator');


    }
}
