<?php

namespace SujanSht\LaraAdmin\Services;
use SujanSht\LaraAdmin\Services\Helper\CommandHelper;
use Illuminate\Support\Facades\Artisan;

class RepositoryPatternService extends CommandHelper
{
    public static function repoPattern($name, $makeRequest = false)
    {
        Self::createFolderIfNotExists(app_path('Contracts'));
        Self::createFolderIfNotExists(app_path('Repositories'));

        Self::makeInterface($name);
        Self::makeRepository($name);
        if($makeRequest){
            Self::makeRequest($name);
        }
    }
    protected static function makeInterface($name)
    {
        file_put_contents(app_path("/Contracts/{$name}RepositoryInterface.php"), Self::generateContent('Interface',$name));
    }
    protected static function makeRepository($name)
    {
        file_put_contents(app_path("/Repositories/{$name}Repository.php"), Self::generateContent('Repository',$name));
    }
    protected static function makeRequest($name)
    {
        Artisan::call('make:request '.$name.'Request');
    }
}
