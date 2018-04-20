<?php

use TCG\Voyager\Traits\Seedable;
use Illuminate\Database\Seeder;

class PageBlocksDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('PageBlocksTableSeeder');
        $this->seed('PageBlocksDataTypesTableSeeder');
        $this->seed('PageBlocksPermissionsTableSeeder');
        $this->seed('PageBlocksPermissionRoleTableSeeder');
    }
}
