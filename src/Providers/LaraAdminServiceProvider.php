<?php

namespace SujanSht\LaraAdmin\Providers;

use App\Models\User;

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SujanSht\LaraAdmin\Models\Admin\Menu;
use SujanSht\LaraAdmin\Models\Admin\Role;
use SujanSht\LaraAdmin\Policies\MenuPolicy;
use SujanSht\LaraAdmin\Policies\RolePolicy;
use SujanSht\LaraAdmin\Policies\UserPolicy;
use SujanSht\LaraAdmin\Models\Admin\Setting;
use SujanSht\LaraAdmin\Policies\SettingPolicy;
use SujanSht\LaraAdmin\View\Components\Action;
use SujanSht\LaraAdmin\Models\Admin\Permission;
use SujanSht\LaraAdmin\View\Components\EditPage;
use SujanSht\LaraAdmin\View\Components\ShowPage;
use SujanSht\LaraAdmin\Policies\PermissionPolicy;
use SujanSht\LaraAdmin\View\Components\IndexPage;
use SujanSht\LaraAdmin\View\Components\CreatePage;
use SujanSht\LaraAdmin\Repositories\MenuRepository;
use SujanSht\LaraAdmin\Repositories\RoleRepository;
use SujanSht\LaraAdmin\Repositories\UserRepository;
use SujanSht\LaraAdmin\View\Components\ImageUpload;
use SujanSht\LaraAdmin\View\Components\AddEditButton;
use SujanSht\LaraAdmin\Console\Commands\CrudGenerator;
use SujanSht\LaraAdmin\Repositories\SettingRepository;
use SujanSht\LaraAdmin\Console\Commands\GenerateService;
use SujanSht\LaraAdmin\Contracts\MenuRepositoryInterface;
use SujanSht\LaraAdmin\Contracts\RoleRepositoryInterface;
use SujanSht\LaraAdmin\Contracts\UserRepositoryInterface;
use SujanSht\LaraAdmin\Repositories\PermissionRepository;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Menu\MenuTable;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Role\RoleTable;
use SujanSht\LaraAdmin\Http\Livewire\Admin\User\UserTable;
use SujanSht\LaraAdmin\Contracts\SettingRepositoryInterface;
use SujanSht\LaraAdmin\Contracts\PermissionRepositoryInterface;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Role\BreadPermission;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Setting\SettingTable;
use SujanSht\LaraAdmin\Console\Commands\RepositoryPatternGenerator;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Media\SpartanImageUpload;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Media\VideoLink;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Permission\PermissionTable;
use SujanSht\LaraAdmin\Http\Livewire\Admin\Role\RoleHasPermissionTable;

class LaraAdminServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        User::class => UserPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Menu::class => MenuPolicy::class,
        Setting::class => SettingPolicy::class,
    ];
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/admin/dashboard';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Ressource
        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }
        // Register Resources
        $this->registerResource();
        // Register Directives
        $this->directives();
        // Register Policies
        $this->registerPolicies();
        // Register View Components
        $this->registerComponents();
        // Register Livewire Component
        $this->registerLivewire();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register Package Commands
        $this->registerCommands();
        /* Repository Interface Binding */
        $this->repos();


    }

    /**
     * Publish Package Resource.
     *
     *@return void
     */
    protected function publishResource()
    {

        // Publish Config File
        $this->publishes([
            __DIR__.'/../../config/lara-admin.php' => config_path('lara-admin.php'),
        ], 'lara-admin-config');
        // Publish View Files
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/lara-admin'),
        ], 'lara-admin-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'lara-admin-migrations');
        // Publish Database Seeds
        $this->publishes([
            __DIR__.'/../../database/seeders' => database_path('seeders'),
        ], 'lara-admin-seeders');
        // Publish Public Assets
        $this->publishes([
            __DIR__.'/../../payload/lara-admin/assets' => public_path('lara-admin/assets'),
        ], 'lara-admin-assets');

    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'lara-admin'); // Loading Views Files
        $this->registerRoutes();
    }

    /**
     * Register Routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/auth.php');
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });

    }

    /**
     * Register Route Configuration.
     *
     * @return void
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => 'admin',
            'middleware' => ['web', 'auth'],
        ];
    }

    /**
     * Register Package Command.
     *
     *@return void
     */
    protected function registerCommands()
    {
        $this->commands([
            CrudGenerator::class,
            GenerateService::class,
            RepositoryPatternGenerator::class,
        ]);
    }

    /**
     * Blade Directives.
     *
     * @return void
     */
    protected function directives()
    {
        Blade::if('hasRole', function ($roles) {
            $hasAccess = false;
            $roles_array = explode('|', $roles);
            foreach ($roles_array as $role) {
                $hasAccess = $hasAccess || Auth::user()->hasRole($role) || Auth::user()->isSuperAdmin();
            }

            return $hasAccess;
        });

    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);

    }



    /**
     * Register View Components.
     *
     *@return void
     */
    protected function registerComponents()
    {
        $this->loadViewComponentsAs('lara-admin', [
            Action::class,
            AddEditButton::class,
            CreatePage::class,
            EditPage::class,
            IndexPage::class,
            ShowPage::class,

        ]);
    }

    /**
     * Register Policies.
     *
     *@return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * Register Livewire Components.
     */
    protected function registerLivewire()
    {
        Livewire::component('admin.menu.menu-table', MenuTable::class);
        Livewire::component('admin.permission.permission-table', PermissionTable::class);
        Livewire::component('admin.role.role-table', RoleTable::class);
        Livewire::component('admin.user.user-table', UserTable::class);
        Livewire::component('admin.role.bread-permission', BreadPermission::class);
        Livewire::component('admin.role.role-has-permission-table', RoleHasPermissionTable::class);
        Livewire::component('admin.setting.setting-table', SettingTable::class);
        Livewire::component('admin.media.spartan-image-upload', SpartanImageUpload::class);
        Livewire::component('admin.media.video-link', VideoLink::class);



    }

}
