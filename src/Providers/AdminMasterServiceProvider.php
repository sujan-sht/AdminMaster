<?php

namespace SujanSht\AdminMaster\Providers;

use App\Models\User;

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SujanSht\AdminMaster\Models\Admin\Menu;
use SujanSht\AdminMaster\Models\Admin\Role;
use SujanSht\AdminMaster\Policies\MenuPolicy;
use SujanSht\AdminMaster\Policies\RolePolicy;
use SujanSht\AdminMaster\Policies\UserPolicy;
use SujanSht\AdminMaster\Models\Admin\Setting;
use SujanSht\AdminMaster\Policies\SettingPolicy;
use SujanSht\AdminMaster\View\Components\Action;
use SujanSht\AdminMaster\Models\Admin\Permission;
use SujanSht\AdminMaster\View\Components\EditPage;
use SujanSht\AdminMaster\View\Components\ShowPage;
use SujanSht\AdminMaster\Policies\PermissionPolicy;
use SujanSht\AdminMaster\View\Components\IndexPage;
use SujanSht\AdminMaster\View\Components\CreatePage;
use SujanSht\AdminMaster\Repositories\MenuRepository;
use SujanSht\AdminMaster\Repositories\RoleRepository;
use SujanSht\AdminMaster\Repositories\UserRepository;
use SujanSht\AdminMaster\View\Components\AddEditButton;
use SujanSht\AdminMaster\Console\Commands\CrudGenerator;
use SujanSht\AdminMaster\Repositories\SettingRepository;
use SujanSht\AdminMaster\Console\Commands\GenerateService;
use SujanSht\AdminMaster\Contracts\MenuRepositoryInterface;
use SujanSht\AdminMaster\Contracts\RoleRepositoryInterface;
use SujanSht\AdminMaster\Contracts\UserRepositoryInterface;
use SujanSht\AdminMaster\Repositories\PermissionRepository;
use SujanSht\AdminMaster\Http\Livewire\Admin\Menu\MenuTable;
use SujanSht\AdminMaster\Http\Livewire\Admin\Role\RoleTable;
use SujanSht\AdminMaster\Http\Livewire\Admin\User\UserTable;
use SujanSht\AdminMaster\Contracts\SettingRepositoryInterface;
use SujanSht\AdminMaster\Contracts\PermissionRepositoryInterface;
use SujanSht\AdminMaster\Http\Livewire\Admin\Role\BreadPermission;
use SujanSht\AdminMaster\Http\Livewire\Admin\Setting\SettingTable;
use SujanSht\AdminMaster\Console\Commands\RepositoryPatternGenerator;
use SujanSht\AdminMaster\Http\Livewire\Admin\Media\SpartanImageUpload;
use SujanSht\AdminMaster\Http\Livewire\Admin\Media\VideoLink;
use SujanSht\AdminMaster\Http\Livewire\Admin\Permission\PermissionTable;
use SujanSht\AdminMaster\Http\Livewire\Admin\Role\RoleHasPermissionTable;

class AdminMasterServiceProvider extends ServiceProvider
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
            __DIR__.'/../../config/admin-master.php' => config_path('admin-master.php'),
        ], 'admin-master-config');
        // Publish View Files
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/admin-master'),
        ], 'admin-master-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'admin-master-migrations');
        // Publish Database Seeds
        $this->publishes([
            __DIR__.'/../../database/seeders' => database_path('seeders'),
        ], 'admin-master-seeders');
        // Publish Public Assets
        $this->publishes([
            __DIR__.'/../../payload/admin-master/assets' => public_path('admin-master/assets'),
        ], 'admin-master-assets');
        // Publish Media Library Modules
        $this->publishes([
            __DIR__.'/../../payload/modules' => app_path('Modules'),
        ], 'media-library-modules');

    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin-master'); // Loading Views Files
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
        $this->loadViewComponentsAs('admin-master', [
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
