<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();

        $system = User::query()->where('username', 'system_manager')->first()
            ?: User::query()->create([
                'first_name' => 'System',
                'last_name' => 'Manager',
                'display_name' => 'System',
                'username' => 'system_manager',
                'email' => 'system@eliroom.com',
                'mobile_number' => null,
                'password' => '',
                'position' => 'System',
                'gender' => null,
                'image_path' => null,
                'birthday' => date("Y/m/d"),
                'state' => \App\Types\State::DISABLED,
                'approved_by' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'approved_at' => date("Y/m/d"),
            ]);

        $superadmin = User::query()->where('username', 'superadmin')->first()
            ?: User::query()->create([
                'first_name' => 'SuperAdmin',
                'last_name' => 'Manager',
                'display_name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@eliroom.com',
                'mobile_number' => null,
                'password' => Hash::make('superadmin'),
                'position' => 'Super Admin',
                'gender' => null,
                'image_path' => null,
                'birthday' => date("Y/m/d"),
                'state' => \App\Types\State::DISABLED,
                'approved_by' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'approved_at' => date("Y/m/d"),
            ]);

        $permissions = Permission::query()->pluck('id');

        $system->permissions()->attach($permissions->toArray());
        $superadmin->permissions()->attach($permissions->toArray());
    }
}
