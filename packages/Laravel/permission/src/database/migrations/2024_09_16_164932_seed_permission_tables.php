<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Laravel\Level\App\Models\Package;
use Laravel\Permission\App\Models\Permission;
use Laravel\Permission\App\Models\PermissionGroup;
use Laravel\Permission\App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissiongroups = [

            // Dashboard
            [
                'name' => 'Dashboard',
            ],
            [
                'name' => 'Users Management',
            ],
            [
                'name' => 'Roles and Permission Management',
            ],
        ];
        echo "--------------------------------------------------" . "\n";
        echo "Seeding permissiongroups table" . "\n";
        echo "--------------------------------------------------" . "\n";
        $seedCount = 0;
        foreach ($permissiongroups as $row) {
            $permission = PermissionGroup::firstOrNew(['name' => $row['name']]);
            foreach ($row as $column => $value) {
                $permission->$column = $value;
            }
            $permission->created_by = 2;
            $permission->updated_by = 2;
            if ($permission->save()) {
                echo "creating permission:- " . $permission->name . "\n";
                $seedCount++;
            } else {
                echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
            }
        }
        echo 'Total of ' . $seedCount . ' permissiongroups have been seeded.' . "\n";


        $permissions = [

            // Dashboard
            [
                'name' => 'Dashboard',
                'permission_group_id' => PermissionGroup::where('name', 'Dashboard')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Dashboard-Roles-Permissions-Count',
                'permission_group_id' => PermissionGroup::where('name', 'Dashboard')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Management Menu',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Create',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User List',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Update',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Block',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Activate',
                'permission_group_id' => PermissionGroup::where('name', 'Users Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Role Create',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Role List',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Role Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Role Update',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Role Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Create',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission List',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Update',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Groups Create',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Groups List',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Groups Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Groups Update',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Groups Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Roles and Permission Management Menu',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permission Group',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Permissions',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'Roles',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Role and Direct Permission',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Role List',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Role Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
            [
                'name' => 'User Role Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Roles and Permission Management')->first()->id,
                'guard_name' => 'web',
            ],
        ];
        echo "--------------------------------------------------" . "\n";
        echo "Seeding permissions table" . "\n";
        echo "--------------------------------------------------" . "\n";
        $seedCount = 0;
        foreach ($permissions as $row) {
            $permission = Permission::firstOrNew(['name' => $row['name'], 'permission_group_id' => $row['permission_group_id']]);
            foreach ($row as $column => $value) {
                $permission->$column = $value;
            }
            if ($permission->save()) {
                echo "creating permission:- " . $permission->name . "\n";
                $seedCount++;
            } else {
                echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
            }
        }
        echo 'Total of ' . $seedCount . ' permissions have been seeded.' . "\n";

        $roles = [
            [
                'guard_name'    => 'web',
                'name'          => 'Super Admin'
            ],
        ];

        echo "--------------------------------------------------" . "\n";
        echo "Seeding roles table" . "\n";
        echo "--------------------------------------------------" . "\n";
        $seedCount = 0;
        foreach ($roles as $row) {
            $role = Role::create(['name' => $row['name']]);
            foreach ($row as $column => $value) {
                $role->$column = $value;
            }
            echo "creating role:- " . $role->name . "\n";

            if ($role->save()) {
                if ($role->id == 1) {
                    $permissions = Permission::all();
                    foreach ($permissions as $permission) {
                        echo "giving persion to Super admin Role: $permission->name" . "\n";
                        $role->givePermissionTo($permission->name);
                    }
                }
                $seedCount++;
            } else {
                echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
            }
        }
        echo 'Total of ' . $seedCount . ' roles have been seeded.' . "\n";

        DB::table('users')->insert([
            [
                'name' => 'admin1',
                'email'      => 'admin1@Laravel.com',
                'password'   => Hash::make('secret'),
                'created_by'        => 2,
                'updated_by'        => 2,
            ],
        ]);
        $rows = [
            [
                'name' => 'admin',
                'email'      => 'admin@Laravel.com',
                'password'   => Hash::make('secret'),
                'email_verified_at' => now()->toDateTimeString(),
            ],
        ];
        $seedCount = 0;
        echo "--------------------------------------------------" . "\n";
        echo 'Seeding Users table' . "\n";
        echo "--------------------------------------------------" . "\n";
        foreach ($rows as $row) {
            $user = User::firstOrNew(['email' => $row['email']]);
            $user->name = $row['name'];
            $user->password = $row['password'];


            if ($user->save()) {
                $user->assignRole('Super Admin');
                echo "User seeded" . $user->name . "\n";
                echo "User seeded" . $user->username . "\n";
                echo "User seeded Role" . $user->getRoleNames() . "\n";
                $seedCount++;
            } else {
                echo "Error while seeding: <pre>" . print_r($user, 1) . "</pre>\n";
            }
        }
        echo 'Total of ' . $seedCount . ' users have been seeded.' . "\n";
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
