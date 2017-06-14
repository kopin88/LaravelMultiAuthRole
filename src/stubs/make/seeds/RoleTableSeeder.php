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
        $role_user->name = 'User';
        $role_user->description= 'Normal User';
        $role_user->save();

        $role_user_manager = new Role();
        $role_user_manager->name = 'User Manager';
        $role_user_manager->description= 'Control all User';
        $role_user_manager->save();

        $role_admin = new Role();
        $role_admin->name = 'Administrator';
        $role_admin->description= 'Full Permission';
        $role_admin->save();

        $role_personal_r = new Role();
        $role_personal_r->name = 'Personal Read';
        $role_personal_r->description= 'Read only Personal';
        $role_personal_r->save();

        $role_personal_w = new Role();
        $role_personal_w->name = 'Personal Write';
        $role_personal_w->description= 'Read & Write Personal';
        $role_personal_w->save();

        $role_personal_m = new Role();
        $role_personal_m->name = 'Personal Manager';
        $role_personal_m->description= 'Personal Manager';
        $role_personal_m->save();

        $role_account_r = new Role();
        $role_account_r->name = 'Account Read';
        $role_account_r->description= 'Read only Account';
        $role_account_r->save();

        $role_account_w = new Role();
        $role_account_w->name = 'Account Write';
        $role_account_w->description= 'Read & Write Account';
        $role_account_w->save();

        $role_account_m = new Role();
        $role_account_m->name = 'Account Manager';
        $role_account_m->description= 'Account Manager';
        $role_account_m->save();

        $role_store_r = new Role();
        $role_store_r->name = 'Store Read';
        $role_store_r->description= 'Read only Store';
        $role_store_r->save();

        $role_store_w = new Role();
        $role_store_w->name = 'Store Write';
        $role_store_w->description= 'Read & Write Store';
        $role_store_w->save();

        $role_store_m = new Role();
        $role_store_m->name = 'Store Manager';
        $role_store_m->description= 'Store Manager';
        $role_store_m->save();


    }
}
