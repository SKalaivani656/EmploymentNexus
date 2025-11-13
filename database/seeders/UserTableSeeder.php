<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use App\Models\Helper\Sequenceidhelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uniqueId = Sequenceidhelper::getNextSequenceId(5, 'EMP', 'App\Models\Admin\Auth\User');

        $user = User::create([
            'name' => 'ADMIN',
            'email' => 'preparenext@gmail.com',
            'password' => '12345678',
            'is_accountactive' => true,
            'role' => 1,
            'sys_id' => $uniqueId['sys_id'],
            'uniqid' => $uniqueId['uniqid'],
            'sequence_id' => $uniqueId['sequence_id'],
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Jobseeker::create([
        //     'name' => 'Customer',
        //     'phone' => 9962408877,
        //     'email' => 'customer@gmail.com',
        //     'is_accountactive' => 1,
        //     'password' => 12345678,
        //     'signupform_status' => 0,
        //     'usertype' => 1,
        //     'active' => 1,
        // ]);

    }
}
