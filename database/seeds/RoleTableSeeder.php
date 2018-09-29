<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'manager';
        $role_user->description = 'A Manager User can manage members for the organization and can assign them roles';
        $role_user->save();
        $role_admin = new Role();
        $role_admin->name = 'readonly';
        $role_admin->description = 'A member with readonly permission can only view the module no operations can be performed';
        $role_admin->save();
        $role_admin = new Role();
        $role_admin->name = 'readwrite';
        $role_admin->description = 'A member with readwrite permission can view the module as well as can perform operations';
        $role_admin->save();

    }
}
