<?php

namespace SujanSht\AdminMaster\Console\Commands;

use SujanSht\AdminMaster\Services\CrudService;
use Illuminate\Console\Command;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a crud with repository pattern';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name=$this->argument('name');
        CrudService::makeCrud($name, $this);
    }
}
