<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $viewUnapprovedLoadingRequests = 'view unapproved loading requests';
        $viewSenderIdRequested = 'view sender ids requested';
        $viewUsers = 'view users';
        $viewLowUnits = 'view low units';
        $createUser = 'create user';
        $createRole ="role-create";
        $viewRoles = "role-list";
        $editRoles = "role-edit";
        $deleteRoles = "role-delete";
        $userList = 'user-list';
        $userCreate = 'user-create';
        $userEdit = 'user-edit';
        $userDelete = 'user-delete';

        // create permissions
        Permission::create(['name' => $viewUnapprovedLoadingRequests]);
        Permission::create(['name' => $viewSenderIdRequested]);
        Permission::create(['name' => $viewUsers]);
        Permission::create(['name' => $viewLowUnits]);
        Permission::create(['name' => $createUser]);
        Permission::create(['name' => $createRole]);
        Permission::create(['name' => $viewRoles]);
        Permission::create(['name' => $editRoles]);
        Permission::create(['name' => $deleteRoles]);
        Permission::create(['name' => $userList ]);
        Permission::create(['name' => $userCreate ]);
        Permission::create(['name' => $userEdit ]);
        Permission::create(['name' => $userDelete ]);

        $superAdmin = 'super-admin';
        $operationsManager = 'operations-manager';
        $financeManager = 'finance-manager';
        $reseller = 'reseller';

        Role::create(['name' => $superAdmin])->givePermissionTo(Permission::all());
        Role::create(['name' => $financeManager])->givePermissionTo($viewUnapprovedLoadingRequests, $viewSenderIdRequested);
        Role::create(['name' => $reseller])->givePermissionTo($viewLowUnits);
        Role::create(['name' => $operationsManager])->givePermissionTo($viewSenderIdRequested);
    }
}
