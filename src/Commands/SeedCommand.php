<?php

namespace Pvtl\VoyagerPageBlocks\Commands;

use TCG\Voyager\Traits\Seedable;
use Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class SeedCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/../../database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'voyager-page-blocks:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with example Page Blocks';

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Seeding data into the database');
        $this->seed('PageBlocksExamplesSeeder');

        $this->info('Successfully seeded Voyager Page Blocks!');
    }
}
