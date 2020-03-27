<?php

namespace Pvtl\VoyagerPageBlocks\Commands;

use TCG\Voyager\Traits\Seedable;
use Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/../../database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'voyager-page-blocks:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Voyager Page Blocks package';

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }

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
        $this->info('Publishing Page Blocks assets, database, and config files');
        $this->call('vendor:publish', ['--provider' => PageBlocksServiceProvider::class]);

        $this->info('Dumping the autoloaded files and reloading all new files');
        $composer = $this->findComposer();
        $process = new Process([$composer, 'dump-autoload']);
        $process->setWorkingDirectory(base_path())->mustRun();

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Seeding required data into the database');
        $this->seed('PageBlocksDatabaseSeeder');

        $this->info('Successfully installed Voyager Page Blocks! Enjoy');
    }
}
