<?php

namespace SujanSht\AdminMaster\Console\Commands;

use SujanSht\AdminMaster\Services\RepositoryPatternService;
use Illuminate\Console\Command;

class RepositoryPatternGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name} {--r|request : Make a request file for repo pattern}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository pattern with request file if -r is used';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $makeRequest = $this->option('request');
        RepositoryPatternService::repoPattern($name,$makeRequest);
        $this->info('Repository Pattern created successfully for model: '. $name);
    }
}
