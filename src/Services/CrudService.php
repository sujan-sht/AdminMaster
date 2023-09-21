<?php

namespace SujanSht\LaraAdmin\Services;

use SujanSht\LaraAdmin\Models\Admin\Menu;
use SujanSht\LaraAdmin\Services\Helper\CommandHelper;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CrudService extends CommandHelper
{
    public static function makeCrud($name, $console)
    {
        Self::createFolderIfNotExists(app_path('Models/Admin'));
        Self::createFolderIfNotExists(app_path('Http/Controllers/Admin'));
        Self::createFolderIfNotExists(resource_path('views/admin/'.strtolower($name)));
        Self::createFolderIfNotExists(app_path("Http/Livewire/Admin/".$name));
        Self::createFolderIfNotExists(app_path("Policies"));


        Self::makeModel($name, $console);
        Self::makeMigration($name, $console);
        Self::makeController($name, $console);
        Self::makeViews($name, $console);
        Self::makeSeeder($name, $console);
        Self::makeBladeLayouts($name, $console);
        Self::addRouteContent($name, $console);
        Self::addFileContent($name, $console);
        Self::makeRappasoftTable($name,$console);
        Self::makePolicy($name,$console);
        Self::makeMenu($name,$console);

        RepositoryPatternService::repoPattern($name,true);
        $console->info('Repo pattern created for model: '.$name);

    }

    protected static function makeModel($name, $console)
    {
        $file = app_path("Models/Admin/".$name.".php");
        file_put_contents($file, Self::generateContent('Model',$name));
        $console->info('Model Created Successfully');
    }

    protected static function makeMigration($name, $console)
    {
        Artisan::call('make:migration create_'.strtolower(Str::plural($name)).'_table --create='.strtolower(Str::plural($name)));
        $console->info('Migration Created Successfully');
    }

    protected static function makeController($name, $console)
    {
        $file = app_path("Http/Controllers/Admin/".$name."Controller.php");
        file_put_contents($file, Self::generateContent('Controller',$name));
        $console->info('Controller Created Successfully');
    }

    protected static function makeViews($name, $console)
    {
        $views = ['index', 'create', 'edit', 'show'];
        foreach ($views as $view) {
            $file = resource_path("views/admin/".strtolower($name)."/{$view}.blade.php");
            file_put_contents($file, self::generateContent(ucfirst($view).'Page', $name));
            $console->info(ucfirst($view).' Page Created Successfully');
        }
    }


    protected static function makeSeeder($name, $console)
    {
        Artisan::call('make:seeder '.$name.'Seeder');
        $console->info('Seeder file Created Successfully');
    }

    protected static function makeBladeLayouts($name,$console)
    {
        Self::createFolderIfNotExists(resource_path("views/admin/layouts/modules/".strtolower($name)));
        file_put_contents(resource_path("views/admin/layouts/modules/".strtolower($name)."/form.blade.php"), '');
        $console->info('Edit add file created successfully');

        file_put_contents(resource_path("views/admin/layouts/modules/".strtolower($name)."/scripts.blade.php"), '');
        $console->info('Script file created successfully');
    }

    protected static function makeRappasoftTable($name,$console)
    {
        $file = app_path("Http/Livewire/Admin/".$name.'/'.$name.'Table.php');
        file_put_contents($file, Self::generateContent('RappasoftTable',$name));
        $console->info('Livewire Table Created Successfully');
    }

    protected static function makePolicy($name, $console)
    {
        $file = app_path("Policies/".$name."Policy.php");
        file_put_contents($file, Self::generateContent('Policy',$name));
        $console->info('Policy Created Successfully');
    }

    protected static function makeMenu($name, $console)
    {
        Menu::create([
            'name' => $name,
            'route' => strtolower(Str::plural($name)),
            'icon' => null,
            'position' => 0,
            'active' => 1,
        ]);
        $console->info('Menu Created Successfully');
    }

    protected static function addRouteContent($name, $console)
    {
        // Adding Route
        $lowercased_name = strtolower(Str::plural($name));
        $route = "Route::resource('{$lowercased_name}',\App\Http\Controllers\Admin\\{$name}Controller::class);\n";

        $filePath = app_path('Mixins/AdminRouteMixins.php'); // Specify the // Read the file content
        $content = file_get_contents($filePath);

        // Search for the symbol
        $position = strpos($content, '});');

        if ($position !== false) {
            // Add content before the symbol
            $content = substr_replace($content, $route, $position, 0);
            // Write the updated content back to the file
            file_put_contents($filePath, $content);

            $console->info('Route added Successfully');

        } else {
            $console->info('Route couldnot be added');
        }
    }

    protected static function addFileContent($name, $console)
    {
        // Adding Route Interface Binding
        $repository_interface_binding = '$this->app->bind(\App\Contracts\\'.$name.'RepositoryInterface::class, \App\Repositories\\'.$name.'Repository::class);';
        $provider_path = app_path('Providers/AdminServiceProvider.php');
        Self::putContentToClassFunction($provider_path, 'protected function repos', $repository_interface_binding);

    }
}
