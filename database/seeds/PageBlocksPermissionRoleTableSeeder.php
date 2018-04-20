<?php

use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;
use Illuminate\Database\Seeder;

class PageBlocksPermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
