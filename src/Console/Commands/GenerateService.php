<?php

namespace SujanSht\LaraAdmin\Console\Commands;

use SujanSht\LaraAdmin\Services\Helper\CommandHelper;
use Illuminate\Console\Command;

class GenerateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath=app_path('Services');
        $name = $this->argument('name');
        CommandHelper::createFolderIfNotExists($folderPath);

        $file = $folderPath.'/'.$name.'.php';

        file_put_contents($file, CommandHelper::generateContent('Service',$name));

        $this->info("Service created successfully: {$file}");
    }

}
