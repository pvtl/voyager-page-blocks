<?php

use TCG\Voyager\Traits\Seedable;
use Illuminate\Database\Seeder;

class PageBlocksExamplesSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('PageBlocksTableSeeder');
    }
}
