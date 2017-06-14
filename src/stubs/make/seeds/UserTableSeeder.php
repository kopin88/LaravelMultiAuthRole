<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Administrator')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@kopin.dev';
        $admin->password = bcrypt('password');
        $admin->remember_token = bcrypt('password');
        $admin->save();

        $admin->roles()->attach($role_admin);
    }
}
